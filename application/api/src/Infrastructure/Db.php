<?php

namespace App\Infrastructure;

use PDO;

class Db
{
    protected $host = '127.0.0.1';
    protected $dbname = 'avatar';
    protected $user = 'user';
    protected $password = 'admin';

    private static $connection;

    /**
     * Db constructor.
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     */
    public function __construct($host, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->dbname = $dbname;
        $this->password = $password;
    }

    /**
     *
     */
    public function dbConnect()
    {
        try {
            self::$connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.'', $this->user, $this->password);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
        self::$connection->exec('SET NAMES UTF8');

        return self::$connection;
    }
}
