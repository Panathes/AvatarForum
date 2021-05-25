<?php

use App\Infrastructure\Controller;
use App\Infrastructure\Db;
use App\Infrastructure\Router;
use App\Domain\Service\UserFactory;

require __DIR__ . '/vendor/autoload.php';


$controller = new Controller(new Db(), new UserFactory());
$router = new Router();

$response = $router->handleRequest($controller);

http_response_code($response->getStatusCode());
if (!is_null($response->getData())) {
    echo json_encode($response->getData());
}
