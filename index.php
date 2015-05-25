<?php
require "vendor/autoload.php";
require "config.php";

$vonage = new \Vonage\Vonage(VONAGE_USERNAME, VONAGE_PASSWORD);
var_dump($vonage->makeCall('NumberToCall')); die();