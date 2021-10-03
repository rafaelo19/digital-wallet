<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
try {
    $connection = new AMQPStreamConnection("fly.rmq.cloudamqp.com", 5672, 'kczkzyms', 'te7SOSx6c91t4uZ_X4megwV_tpJGLVIR', "kczkzyms");
} catch (Throwable $th) {
    print_r($th->getMessage());
    exit;
}
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
