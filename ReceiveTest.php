<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection("fly.rmq.cloudamqp.com", 5672, 'kczkzyms', 'te7SOSx6c91t4uZ_X4megwV_tpJGLVIR', "kczkzyms");
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('test', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}