<?php

namespace App\Infrastructure;

use App\Domain\Service\UserFactory;
use App\View\AvatarView;
use App\View\UserView;

class Controller
{
    protected Db $db;
    protected UserFactory $factory;

    public function __construct(Db $db, UserFactory $factory)
    {
        $this->db = $db;
    }

    public function status(): Response
    {
        return new Response(200, ['status' => 'ok']);
    }

    public function create(): Response
    {
        $user = $this->factory->createUser($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password']);
        $avatar = $this->factory->createAvatar($user, $_FILES['avatar']['path'], $_FILES['avatar']['filename']);

        $this->db->saveUser($user);
        $this->db->saveAvatar($avatar);

        $view = new UserView($user);
        $view->avatar = new AvatarView($avatar);

        return new Response(201, $view);
    }
}
