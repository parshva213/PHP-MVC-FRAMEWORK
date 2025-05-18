<?php
namespace core;

use middleweares\BaseMiddleweare;

class Controller
{
    public function render($view, $params=[]){
        return Application::$app->router->renderView($view,$params);
    }

    public string $layout = 'main';
    public string $action = '';

    public array $middleweares = [];

    public function setLayout($layout){
        $this->layout = $layout;
    }
    public function registerMiddleware(BaseMiddleweare $middleware) {
        $this->middleweares[] = $middleware;
    }

    public function getMiddleweares(): array
    {
        return $this->middleweares;
    }
}

?>