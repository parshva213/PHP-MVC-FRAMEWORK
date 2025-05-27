<?php

namespace core;

use models\User;

class Application
{
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?DbModel $user;
    public View $view;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootpath, array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootpath;
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();           // ✅ FIRST create session
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view = new View($this->request, $this->response, $this->router);

        // ✅ Now use session safely
        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }


    public function run()
    {
        try {
            echo $this->view->resolve();
        } catch (\Exception $e) {
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();       // usually 'id'
        $primaryValue = $user->{$primaryKey};    // e.g., $user->id
        $this->session->set('user', $primaryValue);
        return true;
    }


    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
        $this->response->redirect('/');
    }
    public function getUserFromSession()
    {
        $primaryValue = $this->session->get("user");
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            return $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
        return null;
    }
}
