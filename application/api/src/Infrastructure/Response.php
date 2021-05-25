<?php

namespace App\Infrastructure;

class Response
{
    protected $data;
    protected int $statusCode;

    public function __construct(int $statusCode, $data)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
