<?php

namespace core;

class View
{
    public string $title = "";
    public $request;
    public $response;
    public Router $routes;

    public function __construct(Request $request, Response $response, Router $routes)
    {
        $this->request = $request;
        $this->response = $response;
        $this->routes = $routes;
    }

    public function resolve()
    {
        $method = $this->request->Method();
        $path = $this->request->getPath();
        $callback = $this->routes->resolveRoute($method, $path);
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_error", ['exception' => new \Exception("Page not found", 404)]);
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        if ($view === '_error' && isset($params['exception'])) {
            $exception = $params['exception'];
        }

        $viewContent = $this->readerOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        // return $viewContent . $layoutContent;
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";;
        return ob_get_clean();
    }

    protected function readerOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";;
        return ob_get_clean();
    }
}
