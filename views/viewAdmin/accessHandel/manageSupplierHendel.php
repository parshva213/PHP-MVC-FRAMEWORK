<?php

use cuser\UppdateCompanyDetails;
use cuser\UpdateSupplier;



if (isset($_POST['work']) && $_POST['work'] == 'updateSupplier') {
    $controller = new UpdateSupplier();
    $data = $_POST['updateSupplierData'];
    return $controller->updateSupplier($data);
}

if (isset($_GET['work']) && isset($_GET['company_id']) && $_GET['work'] === 'UpdateFetch') {
    $controller = new UppdateCompanyDetails();
    $company_id = $_GET['company_id'];
    return $controller->fetchcompany($company_id);
}

if (isset($_POST['work']) && $_POST['work'] === 'UpdateCompany') {
    $controller = new UppdateCompanyDetails();
    $data = $_POST['companyData'];
    return $controller->UpdateCompany($data);
}
