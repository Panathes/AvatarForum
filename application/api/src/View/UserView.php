<?php

namespace App\View;

use App\Domain\Model\User;

class UserView
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $mail;
    public ?AvatarView $avatar = null;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->firstname = $user->getFirstname();
        $this->lastname = $user->getLastname();
        $this->mail = $user->getMail();
    }
}
