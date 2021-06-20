<?php

namespace App\RabbitMQ;

use App\Domain\Model\Avatar;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitSender
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private string $queueName;

    private function declareQueue(string $queueName = 'avatar')
    {
        $this->queueName = $queueName;
        $this->connection = GetRabbitConnection::getRabbitConnection();
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($queueName, false, false, false, false);
    }

    public function sendMessage(string $message)
    {
        $this->declareQueue();
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', $this->queueName);
        $this->closeChannel();
    }

    public function sendAvatarPath(Avatar $avatar)
    {
        $this->sendMessage($avatar->getPath());
    }

    private function closeChannel()
    {
        $this->channel->close();
        GetRabbitConnection::closeConnection();
    }
}