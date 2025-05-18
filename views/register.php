<h3>Register Page</h3>
<?php
use form\Form;
$form = Form::begin('', "post");
?>
<!-- // vishal.m@currently.club -->
<div class="row">
    <div class="col">
        <?php echo $form->field($model, ['name' => "firstName", "type" => 'text', 'label' => "First Name"]); ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, ['name' => "lastName", "type" => 'text', 'label' => "Last Name"]); ?>
    </div>
</div>
<?php
echo $form->field($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo $form->field($model, ['name' => "password", "type" => 'password', 'label' => "Password"]);
echo $form->field($model, ['name' => "conform_password", "type" => 'password', 'label' => "Confirm Password"]);
?>
<button type="submit">Submit</button>
<?php
Form::end();
?>