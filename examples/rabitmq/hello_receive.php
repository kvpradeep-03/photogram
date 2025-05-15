<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.selfmade.ninja', 5672, 'pradeep', 'prad2003','kvpradeep60_test');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    //print_r($msg);
    echo ' [x] Received ', $msg->body, "\n";
  };
  
  $channel->basic_consume('hello', '', false, true, false, false, $callback);
  
  try {
      $channel->consume();
  } catch (\Throwable $exception) {
      echo $exception->getMessage();
  }

?>