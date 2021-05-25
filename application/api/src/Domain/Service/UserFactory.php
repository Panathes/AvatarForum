<?php

namespace App\Domain\Service;

use App\Domain\Model\Avatar;
use App\Domain\Model\User;

class UserFactory
{
    public function createUser(string $firstname, string $lastname, string $mail, string $password): User
    {
        $user = new User($mail);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setPassword($password);

        return $user;
    }

    public function createAvatar(User $user, string $path, string $name): Avatar
    {
        $avatar = new Avatar($user, $path);
        $avatar->setName($name);

        return $avatar;
    }
}
