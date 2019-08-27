<?php

use Bernard\Message;
use Bernard\Consumer;
use Bernard\Producer;
use Bernard\Middleware;
use Bernard\Router\SimpleRouter;
use Bernard\Serializer\SimpleSerializer;
use Bernard\QueueFactory\PersistentFactory;

if (file_exists($autoloadFile = __DIR__ . '/../vendor/autoload.php') || file_exists($autoloadFile = __DIR__ . '/../../../autoload.php')) {
    require $autoloadFile;
}

require __DIR__ . '/QueueJobService.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

function get_serializer() {
    return new SimpleSerializer;
}

function get_producer_middleware() {
    return new Middleware\MiddlewareBuilder;
}

function get_consumer_middleware() {
    $chain = new Middleware\MiddlewareBuilder;
    $chain->push(new Middleware\ErrorLogFactory);
    $chain->push(new Middleware\FailuresFactory(get_queue_factory()));

    return $chain;
}

function get_queue_factory() {
    return new PersistentFactory(get_driver(), get_serializer());
}

function get_producer() {
    return new Producer(get_queue_factory(), get_producer_middleware());
}

function get_receivers() {
    return new SimpleRouter([
        'QueueJob' => new QueueJobService
    ]);
}

function get_consumer() {
    return new Consumer(get_receivers(), get_consumer_middleware());
}

function produce() {
    $producer = get_producer();

    $producer->produce(new Message\DefaultMessage('QueueJob', [
        'time' => time(),
    ]));
}

function consume() {
    $queues   = get_queue_factory();
    $consumer = get_consumer();

    $consumer->consume($queues->create('queue-job'));
}
