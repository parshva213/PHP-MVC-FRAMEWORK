<?php

use core\Need;
use cproduct\ProductActivityManager;

$controller = new ProductActivityManager();

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    // if (isset($_GET['state'])) {
    //     return $controller->adminProductState($pid, $_GET['state']);
    // }
    if (isset($_GET['work'])) {
        if (in_array($_GET['work'], [Need::PRODUCT_STATE_ACTIVE, Need::PRODUCT_STATE_INACTIVE])) {
            return $controller->adminProductState($pid, $_GET['work']);
        }
        if ($_GET['work'] == 'UpdateFetch') {
            return $controller->adminProductFetchById($pid);
        }
    }
}

if (isset($_POST['work'])) {
    if ($_POST['work'] === 'Update-product' && isset($_POST['data'])) {
        $data = (array) $_POST['data'];
        return $controller->adminProductUpdateValidate($data);
    }
}
