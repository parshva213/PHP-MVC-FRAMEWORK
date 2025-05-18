<?php
namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use models\ProfileForm;

class SiteController extends Controller{
    
    public function Home(){
        $params = [
            'name' => "TheCodeholic" 
        ];
        return $this->render('home',$params);
    }

    public function Contact(){
        return $this->render('contact');
    }

    public function handleContact(Request $request){
        $body = $request->getBody();
        var_dump($body);
        echo "Handling Submitted Data";
    }

    public function profile(){
        if (!isset(Application::$app->user)) {
            Application::$app->session->set('redirect', '/profile');
            Application::$app->response->redirect('/login');
            return;
        }
        $profile = new ProfileForm();
        $this->setLayout('main');
        return $this->render('profile',[
            'model' => $profile
        ]);
    }

    public function logout(){
        return $this->render('logout');
    }
}

?>