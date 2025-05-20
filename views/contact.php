<h3>Contact Us</h3>
<?php
$this->title = "contact";
use core\Application;
use form\Form;
use form\MultilineText;
use form\TextareaField;


$request = Application::$app->request;

if($request->Method() === $request->isPost()){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}

$form = Form::begin('', "post");
// vishal.m@currently.club
echo $form->field($model, ['name' => "subject", "type" => 'text', 'label' => "Subject"]);
echo $form->field($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo new MultilineText($model, [
    'name' => 'body',
    'label' => 'Body',
    'rows' => 5,
    'cols' => 50,
]);
echo !isset(Application::$app->user) ? "<input type='checkbox' name='check' " . ($model->check === "on" ? "checked" : "") . "> Not have account" : "";
echo $form->field($model, ['name' => "submit", "type" => 'submit', 'label' => ""]);
?>
<?php
Form::end();
?>