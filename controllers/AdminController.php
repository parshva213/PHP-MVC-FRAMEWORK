<?php

namespace controllers;

use core\Controller;

class AdminController extends Controller
{

    public string $rootPages = "viewAdmin/viewPages/";
    public string $rootAccess = "viewAdmin/accessHanel/";

    public function usergivePermission()
    {
        $this->setLayout('main');
        return $this->render($this->rootPages . 'giveLoginPermission');
    }
    public function usergiveAccess()
    {
        $this->setLayout('main');
        return $this->render($this->rootAccess . 'userHandelPermission');
    }

    public function userView()
    {
        $this->setLayout('main');
        return $this->render($this->rootPages . 'usersView');
    }

    public function productList()
    {
        $this->setLayout('main');
        return $this->render($this->rootPages . 'productList');
    }
    public function productgiveAccess()
    {
        return $this->render($this->rootAccess . 'manageProductHendel');
    }
}
