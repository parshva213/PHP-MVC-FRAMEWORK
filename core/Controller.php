<?php

namespace core;


abstract class Controller
{
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public string $layout = 'main';
    public string $action = '';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
