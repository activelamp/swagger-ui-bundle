<?php

if (!is_dir(__DIR__ . '/../vendor')) {
    throw new \Exception('composer update?');
}

$loader = require __DIR__ . '/../vendor/autoload.php';
