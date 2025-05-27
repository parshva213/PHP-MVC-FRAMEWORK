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

    public function delete($id)
    {
        $deleteValidator = new DeleteUserFromValidate();
        return $deleteValidator->delete($id);
    }

    public function Home()
    {
        if (!isset(Application::$app->user)) {
            Application::$app->session->set('redirect', '/');
            Application::$app->response->redirect('/login');
        }
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
        ]);;
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        var_dump($body);
        echo "Handling Submitted Data";
    }

    public function profile()
    {
        if (!isset(Application::$app->user)) {
            Application::$app->session->set('redirect', '/profile');
            Application::$app->response->redirect('/login');
        }
        $profile = new ProfileForm();
        $this->setLayout('main');
        return $this->render('profile', [
            'model' => $profile
        ]);
    }

    public function logout()
    {
        return $this->render('logout');
    }
    public function givePermission()
    {
        return $this->render('access/givePermission');
    }
    public function giveAccess()
    {
        return $this->render('access/giveAccessPermission');
    }

    public function userview()
    {
        $this->setLayout('main');
        return $this->render('view/users');
    }
}
