<?php

use App\Infrastructure\Controller;
use App\Infrastructure\Db;
use App\Infrastructure\Router;

require __DIR__ . '/vendor/autoload.php';


$controller = new Controller(new Db());
$router = new Router();

$response = $router->handleRequest($controller);

http_response_code($response->getStatusCode());
if (!is_null($response->getData())) {
    echo json_encode($response->getData());
}
