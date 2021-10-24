<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(getenv("RABBITMQ_HOST"),
    getenv("RABBITMQ_PORT"),
    getenv("RABBITMQ_USER"),
    getenv("RABBITMQ_PASSWORD"),
    getenv("RABBITMQ_VHOST"));
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}