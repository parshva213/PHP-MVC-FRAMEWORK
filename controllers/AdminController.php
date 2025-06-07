<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use muser\AddSupplierCompanyBankDetail;
use mproduct\AdminProductUpdate;
use muser\AddCompany;
use muser\AddSupplier;
use muser\UppdateSupplier;

class AdminController extends Controller
{

    public string $rootPages = "viewAdmin/viewPages/";
    public string $rootAccess = "viewAdmin/accessHandel/";

    public function usergivePermission()
    {
        $this->setLayout('main');
        return $this->render($this->rootPages . 'giveLoginPermission');
    }
    public function usergiveAccess()
    {
        $this->setLayout('auth');
        return $this->render($this->rootAccess . 'userHandelPermission');
    }

    public function userView()
    {
        $this->setLayout('main');
        return $this->render($this->rootPages . 'usersView');
    }

    public function productList(Request $request)
    {

        $productUpdate = new AdminProductUpdate();

        $this->setLayout('main');
        return $this->render($this->rootPages . 'productList', [
            'model' => $productUpdate
        ]);
    }
    public function productgiveAccess()
    {
        $this->setLayout('auth');
        return $this->render($this->rootAccess . 'manageProductHendel');
    }

    public function supplierView()
    {
        $supplierUpdate = new UppdateSupplier();


        $this->setLayout('main');
        return $this->render($this->rootPages . 'supplierView', [
            'model' => $supplierUpdate
        ]);
    }

    public function supplierAdd()
    {
        $addSupplier = new AddSupplier();
        if (Application::$app->request->isPost()) {
            $addSupplier->loadData(Application::$app->request->getBody());
            if ($addSupplier->validate()) {
                $rawContact = (string) $addSupplier->contact;
                $addSupplier->contact = '+91 ' . substr($rawContact, 0, 5) . '-' . substr($rawContact, 5);
                if ($addSupplier->save()) {
                    Application::$app->session->setFlash('success', 'Supplier added successfully.');
                    return Application::$app->response->redirect('/adminSupplierList');
                }
            }
        }
        $this->setLayout('main');
        return $this->render($this->rootPages . 'addSupplier', [
            'model' => $addSupplier
        ]);
    }
    public function supplierPage(Request $request)
    {
        $this->setLayout('auth');
        $this->render($this->rootAccess . 'manageSupplierHendel');
    }

    public function supplierDetail(Request $request)
    {

        $model = new UppdateSupplier();
        $this->setLayout('main');
        return $this->render($this->rootPages . 'supplierDetail', [
            'model' => $model
        ]);
    }

    public function addSupplierCompany(Request $request)
    {
        $model = new AddCompany();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
                $db = Application::$app->db->pdo;
                $smt = $db->prepare("SELECT max(company_id) from scompany");
                $smt->execute();
                $companyId = $smt->fetchColumn();
                // Application::$app->session->setFlash('success', 'Supplier company added successfully.');
                return Application::$app->response->redirect('/adminsupplierCompanyBankDetail?uid=' . $params['uid'] . '&company_id=' . $companyId);
            }
        }
        $this->setLayout('main');
        return $this->render($this->rootPages . 'addSupplierCompany', [
            'model' => $model
        ]);
    }

    public function addSupplierCompanyBank(Request $request)
    {
        $model = new AddSupplierCompanyBankDetail();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
                Application::$app->session->setFlash('success', 'Supplier company added successfully.');
                return Application::$app->response->redirect('/adminSupplierDetail?uid=' . $params['uid']);
            }
        }
        $this->setLayout('main');
        return $this->render($this->rootPages . 'addSupplierCompanyBankDetail', [
            'model' => $model
        ]);
    }
}
