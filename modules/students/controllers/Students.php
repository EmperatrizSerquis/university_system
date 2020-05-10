<?php
class Students extends Trongate {

    function _init_picture_settings() { 
        $picture_settings['targetModule'] = 'students';
        $picture_settings['maxFileSize'] = 2000;
        $picture_settings['maxWidth'] = 1200;
        $picture_settings['maxHeight'] = 1200;
        $picture_settings['resizedMaxWidth'] = 200;
        $picture_settings['resizedMaxHeight'] = 200;
        $picture_settings['destination'] = 'students_pics';
        $picture_settings['targetColumnName'] = 'picture';
        $picture_settings['thumbnailDir'] = '';
        $picture_settings['thumbnailMaxWidth'] = '';
        $picture_settings['thumbnailMaxHeight'] = '';
        return $picture_settings;
    }

    function manage() {
        $this->module('security');
        $data['token'] = $this->security->_make_sure_allowed();
        $data['order_by'] = 'id';

        //format the pagination
        $data['total_rows'] = $this->model->count('students');
        $data['record_name_plural'] = 'students';

        $data['headline'] = 'Manage Students';
        $data['view_module'] = 'students';
        $data['view_file'] = 'manage';

        $this->template('admin', $data);
    }

    function show() {
        $this->module('security');
        $token = $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('students/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('students/manage');
        } else {
            $data['form_location'] = BASE_URL.'students/submit/'.$update_id;
            $data['update_id'] = $update_id;
            $data['headline'] = 'Student Information';
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
            redirect('students/manage');
        }

        //fetch the form data
        if (($submit == '') && ($update_id > 0)) {
            $data = $this->_get_data_from_db($update_id);
        } else {
            $data = $this->_get_data_from_post();
        }

        $data['headline'] = $this->_get_page_headline($update_id);

        if ($update_id > 0) {
            $data['cancel_url'] = BASE_URL.'students/show/'.$update_id;
            $data['btn_text'] = 'UPDATE STUDENT DETAILS';
        } else {
            $data['cancel_url'] = BASE_URL.'students/manage';
            $data['btn_text'] = 'CREATE STUDENT RECORD';
        }

        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css';
        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/i18n/jquery-ui-timepicker-addon-i18n.min.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/jquery-ui-sliderAccess.js';
        $data['additional_includes_top'] = $additional_includes_top;

        $data['form_location'] = BASE_URL.'students/submit/'.$update_id;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function _get_page_headline($update_id) {
        //figure out what the page headline should be (on the students/create page)
        if (!is_numeric($update_id)) {
            $headline = 'Create New Student Record';
        } else {
            $headline = 'Update Student Details';
        }

        return $headline;
    }

    function submit() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('email_address', 'Email Address', 'required|min_length[7]|max_length[255]|valid email address|valid_email');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = $this->url->segment(3);
                $data = $this->_get_data_from_post();
                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'students');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'students');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('students/show/'.$update_id);

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
                redirect('students/manage');
            }
        }
    }

    function _get_data_from_db($update_id) {
        $students = $this->model->get_where($update_id, 'students');

        if ($students == false) {
            $this->template('error_404');
            die();
        } else {
            $data['first_name'] = $students->first_name;
            $data['last_name'] = $students->last_name;
            $data['email_address'] = $students->email_address;
            return $data;
        }
    }

    function _get_data_from_post() {
        $data['first_name'] = $this->input('first_name', true);
        $data['last_name'] = $this->input('last_name', true);
        $data['email_address'] = $this->input('email_address', true);
        $data['url_string'] = strtolower(url_title($data['last_name']));
        return $data;
    }

}