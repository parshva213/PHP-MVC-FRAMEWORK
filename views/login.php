<h3>Login</h3>
<?php
use form\HtmlForm;
use form\other;
use form\TextBased;

$form = HtmlForm::begin('', "post");
$this->title = "Login";

// vishal.m@currently.club
echo new TextBased($model, ['type' => 'email', 'name' => 'email', 'label' => 'Email']);
echo new TextBased($model, ['type' => 'password', 'name' => 'password', 'label' => 'Password']);
echo new other($model, ['type' => 'submit', 'name' => 'send', 'value' => 'submit' ]);
?>
<button type="submit">Submit</button>
<?php
HtmlForm::end();
?>