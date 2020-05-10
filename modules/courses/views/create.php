<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="w3-card-4">
    <div class="w3-container primary">
        <h4>Course Details</h4>
    </div>
    <form class="w3-container" action="<?= $form_location ?>" method="post">

        <p>
            <label class="w3-text-dark-grey"><b>Course Title</b></label>
            <input type="text" name="course_title" value="<?= $course_title ?>" class="w3-input w3-border w3-sand" placeholder="Enter Course Title">
        </p>
        <p>
            <label class="w3-text-dark-grey"><b>Course Description</b></label>
            <textarea name="course_description" class="w3-input w3-border w3-sand" placeholder="Enter Course Description here..."><?= $course_description ?></textarea>
        </p>


        <p>
            <label  class="w3-text-dark-grey">Start Date: <span class="w3-text-green">(optional)</span></label> 
            <input type="text" class="w3-input w3-border w3-sand" name="start_date" id="start_date_hrer" value="<?= $start_date ?>" placeholder="Select Start Date" /> 
        </p>
        <p>
            <label  class="w3-text-dark-grey">Finish Date: <span class="w3-text-green">(optional)</span></label> 
            <input type="text" class="w3-input w3-border w3-sand" name="finish_date" id="finish_date_hrer" value="<?= $finish_date ?>" placeholder="Select Finish Date" /> 
        </p>

        <script>
            $.timepicker.dateRange(
                $('#start_date_hrer'),
                $('#finish_date_hrer')
            );
        </script>


        <p>
            <label  class="w3-text-dark-grey">Started Time:</label> 
            <input type="text" class="w3-input w3-border w3-sand" name="started_time" id="started_time_bexv" value="<?= $started_time ?>" placeholder="Select Started Time" /> 
        </p>
        <p>
            <label  class="w3-text-dark-grey">Finished Time:</label> 
            <input type="text" class="w3-input w3-border w3-sand" name="finished_time" id="finished_time_bexv" value="<?= $finished_time ?>" placeholder="Select Finished Time" /> 
        </p>

        <script>
        $.timepicker.timeRange(
            $('#started_time_bexv'),
            $('#finished_time_bexv'),
            {
                minInterval: (1000*60*5),
                timeFormat: 'HH:mm'
            }
        );
        </script>

        <p> 
            <?php 
            $attributes['class'] = 'w3-button w3-white w3-border';
            echo anchor($cancel_url, 'CANCEL', $attributes);
            ?> 
            <button type="submit" name="submit" value="Submit" class="w3-button w3-medium primary"><?= $btn_text ?></button>
        </p>
    </form>
</div>

<script>
$('.datepicker').datepicker();
$('.datetimepicker').datetimepicker({
    separator: ' at '
});
$('.timepicker').timepicker();
</script>