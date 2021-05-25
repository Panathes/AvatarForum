<?php

namespace App\Infrastructure;

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
}
