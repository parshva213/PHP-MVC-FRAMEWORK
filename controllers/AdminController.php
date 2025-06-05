<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use mproduct\AdminProductUpdate;
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
            if ($addSupplier->validate() && $addSupplier->save()) {
                Application::$app->session->setFlash('success', 'Supplier added successfully.');
                return Application::$app->response->redirect('/adminSupplierList');
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
}
