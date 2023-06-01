<?php
require __DIR__ .'/vendor/autoload.php';

use App\EasyBrokerApiConsumer;

$consumer = new EasyBrokerApiConsumer('https://api.stagingeb.com/v1/properties', 'l7u502p8v46ba3ppgvj5y2aad50lb9');
$consumer->printTitles();