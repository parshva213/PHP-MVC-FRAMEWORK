<?php

use cproduct\ProductActivityManager;

$controller = new ProductActivityManager;

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    if (isset($_GET['state'])) {
        return $controller->adminProductState($pid, $_GET['state']);
    }
}
