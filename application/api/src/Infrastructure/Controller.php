<?php

namespace App\Infrastructure;

use App\Domain\Service\UserFactory;
use App\RabbitMQ\RabbitSender;
use App\View\AvatarView;
use App\View\UserView;

class Controller
{
    protected Db $db;
    protected UserFactory $factory;

    public function __construct(Db $db, UserFactory $factory)
    {
        $this->db = $db;
        $this->factory = $factory;
    }

    public function status(): Response
    {
        return new Response(200, ['status' => 'ok']);
    }

    public function create(): Response
    {
        $user = $this->factory->createUser($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password']);
        $avatar = $this->factory->createAvatar($user, $_FILES['avatar']['tmp_name'], $_FILES['avatar']['name']);

        try {
            $this->db->saveUser($user);
            $this->db->saveAvatar($avatar);
            $rabbit = new RabbitSender();
            $rabbit->sendAvatarPath($avatar);
        } catch (\Exception $exception) {
            return new Response(400, $exception->getMessage());
        }

        $view = new UserView($user);
        $view->avatar = new AvatarView($avatar);
        return new Response(201, $view);
    }

    public function get(string $id): Response
    {
        $user = $this->db->getUser($id);
        if (null === $user) {
            return Router::getNotFoundResponse();
        }

        $view = new UserView($user);
        $view->avatar = new AvatarView($this->db->getAvatar($user));
        return new Response(200, $view);
    }

    public function getAvatar(string $id): Response
    {
        $path = $this->db->getAvatarPathByUserId($id);
        if (null === $path) {
            return Router::getNotFoundResponse();
        }

        return new Response(200, UPLOAD_DIR.$path, true);
    }
}
