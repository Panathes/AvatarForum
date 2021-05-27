<?php

namespace App\Infrastructure;

class Response
{
    protected $data;
    protected int $statusCode;
    protected bool $file;

    public function __construct(int $statusCode, $data, bool $file = false)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->file = $file;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function isFile(): bool
    {
        return $this->file;
    }
}
