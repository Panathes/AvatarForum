<?php

namespace App\Infrastructure;

class Router
{
    /**
     * @var array|Route[]
     */
    protected array $routes = [];

    public function __construct()
    {
        $this->routes[] = new Route('/users', 'POST', 'create');
        $this->routes[] = new Route('/', 'GET', 'status');
        $this->routes[] = new Route('/', 'GET', 'test');
    }

    public function handleRequest(Controller $controller): Response
    {
        foreach ($this->routes as $route) {
            if ($_SERVER['REQUEST_URI'] === $route->getUri() && $_SERVER['REQUEST_METHOD'] === $route->getMethod()) {
                return $controller->{$route->getController()}();
            }
        }
        return self::getNotFoundResponse();
    }

    public static function getNotFoundResponse(): Response
    {
        return new Response(404, 'Resource not found !');
    }
}
