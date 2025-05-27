<?php 
/**@var $exception \Exception */
$this->title = "Error";
echo "<h1>" . $exception->getCode() . " - " . $exception->getMessage() . "</h1>";
?>