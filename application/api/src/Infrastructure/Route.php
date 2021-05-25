<?php

namespace App\Infrastructure;

class Route
{
    protected string $uri;
    protected string $method;
    protected string $controller;

    public function __construct(string $uri, string $method, string $controller)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->controller = $controller;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}
