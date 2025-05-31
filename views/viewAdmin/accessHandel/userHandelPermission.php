<?php

use cuser\UserActivityManage;

$controller = new UserActivityManage();

if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $controller->adminValidateSuccess($uid);
}

if (isset($_GET['uid']) && isset($_GET['active'])) {

    $uid = $_GET['uid'];
    $activity = $_GET['active'] ?? null;
    $controller->adminLoginStatusManage($uid, $activity);
}
