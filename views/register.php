<h3>Register Page</h3>
<?php
$this->title = "register";
use form\HtmlForm;
use form\TextBased;

$form = HtmlForm::begin('', "post");
?>
<!-- // vishal.m@currently.club -->
<div class="row">
    <div class="col">
        <?php echo new TextBased($model, ['name' => "firstName", "type" => 'text', 'label' => "First Name"]); ?>
    </div>
    <div class="col">
        <?php echo new TextBased($model, ['name' => "lastName", "type" => 'text', 'label' => "Last Name"]); ?>
    </div>
</div>
<?php
echo new TextBased($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo new TextBased($model, ['name' => "password", "type" => 'password', 'label' => "Password"]);
echo new TextBased($model, ['name' => "conform_password", "type" => 'password', 'label' => "Confirm Password"]);
?>
<button type="submit">Submit</button>
<?php
HtmlForm::end();
?>