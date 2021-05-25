<?php

namespace App\Infrastructure;

class Controller
{
    protected Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function create(): Response
    {
        return new Response(201, 'to do');
    }
}
