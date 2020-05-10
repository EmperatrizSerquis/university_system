<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="w3-card-4">
    <div class="w3-container primary">
        <h4>Student Details</h4>
    </div>
    <form class="w3-container" action="<?= $form_location ?>" method="post">

        <p>
            <label class="w3-text-dark-grey"><b>First Name</b></label>
            <input type="text" name="first_name" value="<?= $first_name ?>" class="w3-input w3-border w3-sand" placeholder="Enter First Name">
        </p>
        <p>
            <label class="w3-text-dark-grey"><b>Last Name</b></label>
            <input type="text" name="last_name" value="<?= $last_name ?>" class="w3-input w3-border w3-sand" placeholder="Enter Last Name">
        </p>
        <p>
            <label class="w3-text-dark-grey"><b>Email Address</b> <span class="w3-text-green">(optional)</span></label>
            <input type="email" name="email_address" value="<?= $email_address ?>" class="w3-input w3-border w3-sand" placeholder="Enter Email Address">
        </p>
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