<h3>Contact Us</h3>
<?php
$this->title = "contact";
use core\Application;
use form\Form;
use form\TextareaField;

$form = Form::begin('', "post");
// vishal.m@currently.club
echo $form->field($model, ['name' => "subject", "type" => 'text', 'label' => "Subject"]);
$em = (isset(Application::$app->user)) ? Application::$app->user->email : "";
echo $form->field($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo new TextareaField($model, [
    'name' => 'body',
    'label' => 'Body',
    'rows' => 5, // Optional, defaults to 5
    'cols' => 50, // Optional, defaults to 50
    'placeholder' => 'Enter your message'
]);
echo !isset(Application::$app->user) ? "<input type='checkbox' name='check' " . ($model->check === "on" ? "checked" : "") . "> Not have account" : "";
echo $form->field($model, ['name' => "submit", "type" => 'submit', 'label' => ""]);
?>
<?php
Form::end();
?>