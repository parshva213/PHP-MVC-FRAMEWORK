<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use muser\ForgetPasswordChange;
use muser\LoginForm;
use muser\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // If you need session or response, get them via Application::$app
        $session = Application::$app->session;
        $response = Application::$app->response;
        $loginForm = new LoginForm();
        $redirect = $session->get('redirect') ?? '/';
        $session->set('redirect', '/');
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $session->setFlash('success', "Login Successful");
                $response->redirect($redirect);
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }
    public function register(Request $request)
    {
        $response = Application::$app->response;
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', "Thanks for registering" . PHP_EOL . "Your details are under process wait until process complete");
                $response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function fpass(Request $request)
    {
        $fpass = new ForgetPasswordChange();

        if ($request->isPost()) {
            $session = Application::$app->session;
            $fpass->loadData($request->getBody());
            if ($fpass->save()) {
                $session->setFlash('success', "Update successful");
                header("Location: /login");
                exit;
            } else {
                $session->setFlash('error', "Not update successfully");
            }
        }

        $this->setLayout('auth');
        return $this->render('Forgetpassword', ['model' => $fpass]);
    }
}
