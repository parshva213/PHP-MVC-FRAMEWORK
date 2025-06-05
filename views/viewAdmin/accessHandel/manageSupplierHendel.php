<?php

use cuser\UppdateSupplier;

$controller = new UppdateSupplier();
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    if (isset($_GET['work']) && $_GET['work'] == 'supplierDetailFetch') {
        return $controller->supplierDetailFetch($uid);
    }
}
