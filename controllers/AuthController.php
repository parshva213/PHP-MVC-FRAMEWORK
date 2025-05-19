<?php
namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use core\Session;
use core\exception\ForbiddenException;
use middleweares\AuthMiddleweare;
use models\LoginForm;
use models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleweare(['profile']));
    }

    public function login(Request $request){
        // If you need session or response, get them via Application::$app
        $session = Application::$app->session;
        $response = Application::$app->response;
        $loginForm = new LoginForm();
        if ($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $session->setFlash('success', "Login Successful");
                $redirect = Application::$app->session->get('redirect') ?? '/';
                Application::$app->session->remove('redirect');
                $response->redirect($redirect);
            }

        }
        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $loginForm
        ]);
    }
    public function register(Request $request){
        $user = new User();
        if ($request->isPost()){
            $user->loadData($request->getBody());
            if($user->validate() && $user->save()){
                Application::$app->login($user);
                Application::$app->session->setFlash('success', "Thanks for registering");
                echo "<form id='redirectForm' method='POST' action='/login'>";
                echo "<input type='hidden' name='email' value='{$user->email}'>";
                echo "<input type='hidden' name='password' value='{$user->conform_password}'>";
                echo "</form>";
                echo "<script>document.getElementById('redirectForm').submit();</script>";
                return;
            }

        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }
    
    
}

?>