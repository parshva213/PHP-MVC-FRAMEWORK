<?php

use cuser\UppdateCompanyDetails;
use cuser\UpdateSupplier;

echo "manage" . http_response_code();

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
    echo "manage if" . http_response_code();
    $controller = new UppdateCompanyDetails();
    $data = $_POST['companyData'];
    return $controller->UpdateCompany($data);
}
