<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.selfmade.ninja', 5672, 'pradeep', 'prad2003','kvpradeep60_test');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
$messsage = readline("Enter the message to send: ");
$msg = new AMQPMessage($messsage);
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent your message!'\n";

$channel->close();
$connection->close();

?>