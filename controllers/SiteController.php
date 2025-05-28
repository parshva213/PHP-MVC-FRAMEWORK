<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\DeleteUserFromValidate;
use core\Request;
use models\ProfileForm;
use models\ContactForm;

class SiteController extends Controller
{

    public function Home()
    {
        $namedis = Application::$app->user ? Application::$app->user->getDisplayName() : "Guest!";
        $params = [
            'name' => $namedis
        ];
        return $this->render('home', $params);
    }

    public function Contact(Request $request)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $session = Application::$app->session;
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->submit()) {
                $session->setFlash('success', "Submited Successful");
            }
        }
        $this->setLayout('main');
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

    public function profile(Request $request)
    {
        if (!isset(Application::$app->user)) {
            $path = Application::$app->request->getPath();
            Application::$app->session->set('redirect', $path);
            Application::$app->response->redirect('/login');
        }

        $profile = new ProfileForm();
        $profile->fetch();
        if ($request->isPost()) {
            $session = Application::$app->session;
            $profile->loadData($request->getBody());
            if ($profile->validate() && $profile->submit()) {
                $session->setFlash('success', "Submited Successful");
            }
        }
        $this->setLayout('main');
        return $this->render('profile', [
            'model' => $profile
        ]);
    }

    public function logout()
    {
        return $this->render('logout');
    }
}
