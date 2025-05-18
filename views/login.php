<h3>Login</h3>
<?php
use form\Form;
$form = Form::begin('', "post");
// vishal.m@currently.club
echo $form->field($model, ['name' => "email", "type" => 'email', 'label' => "Email"]);
echo $form->field($model, ['name' => "password", "type" => 'password', 'label' => "Password"]);
?>
<button type="submit">Submit</button>
<?php
Form::end();
?>