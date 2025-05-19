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
    public function resolveRoute(string $method, string $path)
    {
        return $this->routes[$method][$path] ?? false;
    }
}

?>