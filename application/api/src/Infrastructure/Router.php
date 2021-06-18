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
        $this->routes[] = new Route("/test", "GET", "test");
        $this->routes[] = new Route('/', 'GET', 'status');
        $this->routes[] = new Route('/users/(\d*)/avatar', 'GET', 'getAvatar');
        $this->routes[] = new Route('/users/(\d*)', 'GET', 'get');
        $this->routes[] = new Route('/users', 'POST', 'create');
    }

    public function handleRequest(Controller $controller): Response
    {
        foreach ($this->routes as $route) {
            $matches = [];
            preg_match('#^'.$route->getUri().'$#', $_SERVER['REQUEST_URI'], $matches, PREG_UNMATCHED_AS_NULL);
            if ($_SERVER['REQUEST_METHOD'] === $route->getMethod() && !is_null($matches[0])) {
                if (is_null($matches[1])) {
                    return $controller->{$route->getController()}();
                } else {
                    return $controller->{$route->getController()}($matches[1]);
                }
            }
        }
        return self::getNotFoundResponse();
    }

    public static function getNotFoundResponse(): Response
    {
        return new Response(404, 'Resource not found !');
    }
}
