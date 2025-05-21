<h3>Contact Us</h3>
<?php
$this->title = "contact";
use core\Application;
use form\HtmlForm;
use form\MultilineText;
use form\other;
use form\TextBased;

$request = Application::$app->request;
$form = HtmlForm::begin('', "post");
// vishal.m@currently.club
echo new TextBased($model, ['name' => "subject", "type" => 'text', 'label' => "Subject"]);
echo new TextBased($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo new MultilineText($model, ['name' => 'body', 'label' => 'Body', 'rows' => 5, 'cols' => 50]);
echo !isset(Application::$app->user) ? "<input type='checkbox' name='check' " . ($model->check === "on" ? "checked" : "") . "> Not have account" : "";
echo new other($model, ['name' => "submit", "type" => 'submit', 'label' => ""]);
?>
<?php
HtmlForm::end();
?>