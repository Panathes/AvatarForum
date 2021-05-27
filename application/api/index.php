<?php

use App\Infrastructure\Controller;
use App\Infrastructure\Db;
use App\Infrastructure\Router;
use App\Domain\Service\UserFactory;

require __DIR__ . '/vendor/autoload.php';

const ROOT_DIR = __DIR__;
const UPLOAD_DIR = ROOT_DIR.'/upload/';

$controller = new Controller(new Db(), new UserFactory());
$router = new Router();

$response = $router->handleRequest($controller);

http_response_code($response->getStatusCode());
$data = $response->getData();
if (!is_null($data)) {
    if ($response->isFile() && file_exists($data)) {
        if ($image_info = getimagesize($data)) {
            header('Content-Type: ' . $image_info['mime']);
        }
        header('Content-Length: ' . filesize($data));

        readfile($data);
    } else {
        echo json_encode($response->getData());
    }
}
