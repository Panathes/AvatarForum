<?php

namespace App;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Messenger
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    public function createAvatarChanel()
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('avatar', false, false, false, false);
    }

    public function waitAvatarChanel()
    {
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }

    public function sendAvatarPath($callback)
    {
        $this->channel->basic_consume('avatar', '', false, true, false, false, $callback);
    }
}
