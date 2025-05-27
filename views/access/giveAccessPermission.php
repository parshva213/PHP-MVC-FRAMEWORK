<?php

use core\Application;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $controller = new \controllers\SiteController();
    $controller->delete($uid);
}
