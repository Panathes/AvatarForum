<?php

namespace App\Infrastructure;

use App\Domain\Model\Avatar;
use App\Domain\Model\User;
use PDO;
use PDOException;

class Db
{
    protected string $host;
    protected string $dbname;
    protected string $user;
    protected string $password;

    private PDO $connection;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: '127.0.0.1';
        $this->user = getenv('DB_USER') ?: 'avatar';
        $this->dbname = getenv('DB_NAME') ?: 'user';
        $this->password = getenv('DB_PASS') ?: 'admin';
        $this->dbConnect();
    }

    private function dbConnect()
    {
        try {
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.'', $this->user, $this->password);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
        $this->connection->exec('SET NAMES UTF8');
    }

    /**
     * @param \PDOStatement $stmt
     * @throws \Exception
     */
    private static function errorHandler(\PDOStatement $stmt): void
    {
        if ($stmt->errorCode() !== '00000') {
            throw new \Exception($stmt->errorInfo()[1]);
        }
    }

    public function saveUser(User $user)
    {
        $sql = "INSERT INTO `user`(
  `firstname`,
  `lastname`,
  `mail`,
  `password`
) VALUES (
  :firstname,
  :lastname,
  :mail,
  :password
)
;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":firstname", htmlspecialchars($user->getFirstname()));
        $stmt->bindValue(":lastname", htmlspecialchars($user->getLastname()));
        $stmt->bindValue(":mail", htmlspecialchars($user->getMail()));
        $stmt->bindValue(":password", htmlspecialchars($user->getPassword()));
        $stmt->execute();
        self::errorHandler($stmt);
        $id = (int)$this->connection->lastInsertId();
        $user->setId($id);
        return $id;
    }

    public function saveAvatar(Avatar $avatar)
    {
        $sql = "INSERT INTO `avatar`(
  `user_id`,
  `path`,
  `name`
) VALUES (
  :user_id,
  :path_,
  :name_,
)
;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":user_id", htmlspecialchars($avatar->getUser()->getId()));
        $stmt->bindValue(":path_", htmlspecialchars($avatar->getPath()));
        $stmt->bindValue(":name_", htmlspecialchars($avatar->getName()));
        $stmt->execute();
        self::errorHandler($stmt);
        $id = (int)$this->connection->lastInsertId();
        $avatar->setId($id);
        return $id;
    }
}
