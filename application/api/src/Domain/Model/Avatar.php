<?php

namespace App\Domain\Model;

class Avatar
{
    protected int $id;
    protected User $user;
    protected string $path;
    protected string $name;

    public function __construct(User $user, string $path)
    {
        $this->user = $user;
        $this->path = $path;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
