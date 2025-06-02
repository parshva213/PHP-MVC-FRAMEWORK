<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use mproduct\AdminProductUpdate;

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

        if ($request->isPost()) {
            $session = Application::$app->session;
        }

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
}
