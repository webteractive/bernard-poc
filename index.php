<?php 
use Predis\Client;
use Bernard\Driver\PredisDriver;

function get_driver() {
  return new PredisDriver(new Client(null, array(
    'prefix' => 'bernard:',
  )));
}

require __DIR__ . '/src/webstrap.php';

produce();