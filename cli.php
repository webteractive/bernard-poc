<?php

require __DIR__ . '/src/predis.php';

function main() {
  if (!isset($_SERVER['argv'][1])) {
      die('You must provide an argument of either "consume" or "produce"');
  }

  if ($_SERVER['argv'][1] == 'produce') {
      produce();
  }

  if ($_SERVER['argv'][1] == 'consume') {
      consume();
  }
}

// Run this diddy
main();