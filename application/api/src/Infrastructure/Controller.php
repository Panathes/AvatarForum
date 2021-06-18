<?php

namespace App\Infrastructure;

use App\RabbitMQ\GetRabbitConnection;
use App\RabbitMQ\RabbitSender;

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::dbConnect();
    }

    public function status(): Response
    {
        return new Response(200, ['status' => 'ok']);
    }

    public function create(): Response
    {
        return new Response(201, 'to do');
    }

    public function test(): Response
    {
        $rabbit = new RabbitSender("/uploads");
        $rabbit->declareQueue("resize");
        $rabbit->sendMessage("Coucouc les petits lapins");
        GetRabbitConnection::closeConnectiion();
        return new Response(200, "Ok ca marche inch ");
    }
}
