<?php
class Courses extends Trongate {

  function resume() {
      $this->module('security');
      $data['token'] = $this->security->_make_sure_allowed();
      $data['order_by'] = 'id';

      //format the pagination
      $data['total_rows'] = $this->model->count('courses');
      $data['record_name_plural'] = 'courses';

      $data['headline'] = 'Resume Courses';
      $data['view_module'] = 'courses';
      $data['view_file'] = 'resume';

      $this->template('admin', $data);
  }

  function api_lecturer() {
    api_auth();

    $sql = '
       SELECT
         c.*,
         l.first_name,
         l.last_name
       FROM
         courses c, lecturers l, associated_courses_and_lecturers a
       WHERE
         a.courses_id = c.id
       AND
         a.lecturers_id = l.id
       ORDER BY
         c.course_title asc
    ';

     $rows = $this->model->query($sql,'object');

     foreach ($rows as $course) {
       $row_data['id'] = $course->id;
       $row_data['url_string'] = $course->url_string;
       $row_data['course_title'] = $course->course_title;
       $row_data['first_name'] = $course->first_name;
       $row_data['last_name'] = $course->last_name;
       $row_data['start_date'] = $course->start_date;

       $data[] = $row_data;
     }

          header('Access-Control-Allow-Origin: *');
          header('Content-Type: application/json');
          $output['body'] = json_encode($data);
          $output['code'] = 200;
          $output['module_name'] = 'courses';
          $code = $output['code'];
          http_response_code($code);
          echo $output['body'];

  }

    function manage() {
        $this->module('security');
        $data['token'] = $this->security->_make_sure_allowed();
        $data['order_by'] = 'id';

        //format the pagination
        $data['total_rows'] = $this->model->count('courses');
        $data['record_name_plural'] = 'courses';

        $data['headline'] = 'Manage Courses';
        $data['view_module'] = 'courses';
        $data['view_file'] = 'manage';

        $this->template('admin', $data);
    }

    function show() {
        $this->module('security');
        $token = $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('courses/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('courses/manage');
        } else {
            $data['form_location'] = BASE_URL.'courses/submit/'.$update_id;
            $data['update_id'] = $update_id;
            $data['headline'] = 'Course Information';
            $data['start_date'] = $this->_date_to_words($data['start_date']);
            $data['finish_date'] = $this->_date_to_words($data['finish_date']);
            $data['started_time'] = $this->_time_to_words($data['started_time']);
            $data['finished_time'] = $this->_time_to_words($data['finished_time']);
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    function create() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);
        $submit = $this->input('submit', true);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('courses/manage');
        }

        //fetch the form data
        if (($submit == '') && ($update_id > 0)) {
            $data = $this->_get_data_from_db($update_id);
            $data['start_date'] = date('m/d/Y', strtotime($data['start_date']));
            $data['finish_date'] = date('m/d/Y', strtotime($data['finish_date']));
            $data['started_time'] = substr($data['started_time'], 0, -3);
            $data['finished_time'] = substr($data['finished_time'], 0, -3);
        } else {
            $data = $this->_get_data_from_post();
        }

        $data['headline'] = $this->_get_page_headline($update_id);

        if ($update_id > 0) {
            $data['cancel_url'] = BASE_URL.'courses/show/'.$update_id;
            $data['btn_text'] = 'UPDATE COURSE DETAILS';
        } else {
            $data['cancel_url'] = BASE_URL.'courses/manage';
            $data['btn_text'] = 'CREATE COURSE RECORD';
        }

        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css';
        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/i18n/jquery-ui-timepicker-addon-i18n.min.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/jquery-ui-sliderAccess.js';
        $data['additional_includes_top'] = $additional_includes_top;

        $data['form_location'] = BASE_URL.'courses/submit/'.$update_id;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function _get_page_headline($update_id) {
        //figure out what the page headline should be (on the courses/create page)
        if (!is_numeric($update_id)) {
            $headline = 'Create New Course Record';
        } else {
            $headline = 'Update Course Details';
        }

        return $headline;
    }

    function submit() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('course_title', 'Course Title', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('course_description', 'Course Description', 'required|min_length[2]');
            $this->validation_helper->set_rules('start_date', 'Start Date', 'required|valid_datepicker_us');
            $this->validation_helper->set_rules('finish_date', 'Finish Date', 'valid_datepicker_us|required');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = $this->url->segment(3);
                $data = $this->_get_data_from_post();

                //convert date and time pickers into db friendly format
                $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                $data['finish_date'] = date('Y-m-d', strtotime($data['finish_date']));
                $data['started_time'] = $data['started_time'] .':00';
                $data['finished_time'] = $data['finished_time'] .':00';

                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'courses');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'courses');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('courses/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

    }

    function submit_delete() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {
            $update_id = $this->url->segment(3);

            if (!is_numeric($update_id)) {
                die();
            } else {
                $data['update_id'] = $update_id;

                //delete all of the comments associated with this record
                $sql = 'delete from comments where target_table = :module and update_id = :update_id';
                $data['module'] = $this->module;
                $this->model->query_bind($sql, $data);

                //delete the record
                $this->model->delete($update_id, $this->module);

                //set the flashdata
                $flash_msg = 'The record was successfully deleted';
                set_flashdata($flash_msg);

                //redirect to the manage page
                redirect('courses/manage');
            }
        }
    }

    function _get_data_from_db($update_id) {
        $courses = $this->model->get_where($update_id, 'courses');

        if ($courses == false) {
            $this->template('error_404');
            die();
        } else {
            $data['course_title'] = $courses->course_title;
            $data['course_description'] = $courses->course_description;
            $data['start_date'] = $courses->start_date;
            $data['finish_date'] = $courses->finish_date;
            $data['started_time'] = $courses->started_time;
            $data['finished_time'] = $courses->finished_time;
            return $data;
        }
    }

    function _get_data_from_post() {
        $data['course_title'] = $this->input('course_title', true);
        $data['course_description'] = $this->input('course_description', true);
        $data['start_date'] = $this->input('start_date', true);
        $data['finish_date'] = $this->input('finish_date', true);
        $data['started_time'] = $this->input('started_time', true);
        $data['finished_time'] = $this->input('finished_time', true);
        $data['url_string'] = strtolower(url_title($data['course_title']));
        return $data;
    }

    function _date_to_words($date) {
        $date = date('l, F jS Y', strtotime($date));
        return $date;
    }

    function _time_to_words($time) {
        $time = date('g:i A', strtotime($time));
        return $time;
    }

    function _prep_output($output) {
        $output['body'] = json_decode($output['body']);
        foreach($output['body'] as $key => $value) {
            $output['body'][$key] ->start_date = $this->_date_to_words($value->start_date);
            $output['body'][$key] ->finish_date = $this->_date_to_words($value->finish_date);
            $output['body'][$key] ->started_time = $this->_time_to_words($value->started_time);
            $output['body'][$key] ->finished_time = $this->_time_to_words($value->finished_time);
        }

        $output['body'] = json_encode($output['body']);

        return $output;
    }

}
