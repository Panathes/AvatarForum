<?php

namespace App\View;

use App\Domain\Model\Avatar;

class AvatarView
{
    public int $id;
    public string $path;
    public string $name;

    public function __construct(Avatar $avatar)
    {
        $this->id = $avatar->getId();
        $this->path = $avatar->getPath();
        $this->name = $avatar->getName();
    }
}
