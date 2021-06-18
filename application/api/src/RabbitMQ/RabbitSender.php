<?php


namespace App\RabbitMQ;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitSender
{
    private string $pathFile;
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private string $queueName;

    public function __construct(string $pathFile)
    {
        $this->pathFile = $pathFile;
        $this->connection = GetRabbitConnection::getRabbitConnection();
        $this->channel = $this->connection->channel();
    }

    public function declareQueue(string $queueName)
    {
        $this->queueName = $queueName;
        $this->channel->queue_declare($queueName, false, false, false, false);
    }

    public function sendMessage(string $message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, "", $this->queueName);
        echo " [x ] Sent '" . $message . "'\n";
    }

    public function closeChannel()
    {
        $this->channel->close();
    }
}