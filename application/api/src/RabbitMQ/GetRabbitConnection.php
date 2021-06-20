<?php


namespace App\RabbitMQ;


use PhpAmqpLib\Connection\AMQPStreamConnection;

class GetRabbitConnection
{
    private static $rabbitConnection;
    
    public static function getRabbitConnection(): AMQPStreamConnection {
        if (is_null(self::$rabbitConnection)) {
            try {
                self::$rabbitConnection = new AMQPStreamConnection("rabbitmq", "5672", "guest", "guest");
            } catch (\Exception $e) {
                die($e);
            }
        }
        return self::$rabbitConnection;
    }

    public static function closeConnection() {
        try {
            self::$rabbitConnection->close();
        } catch (\Exception $e) {
            die($e);
        }
    }
}