<?php

use controllers\UserController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $controller = new UserController();
    $controller->delete($uid);
}

if (isset($_GET['uid']) && isset($_GET['active'])) {
    $uid = $_GET['uid'];
    $activity = $_GET['active'] ?? null;
    $controller = new UserController();
    $controller->update($uid, $activity);
}
