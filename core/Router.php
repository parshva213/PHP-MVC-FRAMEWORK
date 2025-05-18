<?php
namespace core;
class Router
{
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    protected array $routes = [];
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback; // Add POST route
    }
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->Method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_error", ['exception' => new \Exception("Page not found", 404)]);
        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback)){
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = Application::$app->controller;

            foreach ($controller->getMiddleweares() as $middleweare) {
                $middleweare->execute();
            }
        }
        return call_user_func($callback, $this->request);
    }
    public function renderView($view, $params=[]){
        if ($view === '_error' && isset($params['exception'])) {
            $exception = $params['exception'];
        }
        $layoutContent = $this->layoutContent();
        $viewContent = $this->readerOnlyView($view,$params);
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    public function renderContent($viewContent){
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function layoutContent(){
        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once Application::$ROOT_DIR."/views/layout/$layout.php";;
        return ob_get_clean();
    }

    protected function readerOnlyView($view,$params)
    {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";;
        return ob_get_clean();
    }
}

?>