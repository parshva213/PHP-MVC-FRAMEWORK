<?php

namespace controllers;

use core\Controller;
use core\UserActivityManage;

class UserController extends Controller
{

    public function givePermission()
    {
        $this->setLayout('main');
        return $this->render('access/givePermission');
    }
    public function giveAccess()
    {
        $this->setLayout('main');
        return $this->render('access/giveAccessPermission');
    }

    public function userview()
    {
        $this->setLayout('main');
        return $this->render('view/usersView');
    }

    public function delete($id)
    {
        $deleteValidator = new UserActivityManage();
        return $deleteValidator->delete($id);
    }

    public function update($uid, $activity)
    {
        $updateValidator = new UserActivityManage();
        return $updateValidator->update($uid, $activity);
    }
}
