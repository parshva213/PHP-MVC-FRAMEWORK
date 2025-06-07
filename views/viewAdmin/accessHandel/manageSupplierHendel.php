<?php

use cuser\UpdateSupplier;


$controller = new UpdateSupplier();

if (isset($_POST['work']) && $_POST['work'] == 'updateSupplier') {
    $data = $_POST['updateSupplierData'];
    return $controller->updateSupplier($data);
}
