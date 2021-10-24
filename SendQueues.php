<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection(getenv("RABBITMQ_HOST"),
    getenv("RABBITMQ_PORT"),
    getenv("RABBITMQ_USER"),
    getenv("RABBITMQ_PASSWORD"),
    getenv("RABBITMQ_VHOST"));



$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

for ($i = 0; $i < 100; $i++) {
    $msg = new AMQPMessage("Messages $i");
    $channel->basic_publish($msg, '', 'hello');
}

$channel->queue_declare('test', false, false, false, false);

for ($i = 0; $i < 100; $i++) {
    $msg = new AMQPMessage("Messages $i");
    $channel->basic_publish($msg, '', 'test');
}

echo " [x] Sent 'Hello World!'\n";
