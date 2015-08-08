<?php
require "vendor/autoload.php";
require "config.php";

$vonage = new \Vonage\Vonage('vonageUsername', 'VonagePassword');
$params = array(
    'start' => date('Y-m-d\TH:i:sP')
);
var_dump($vonage->request('callhistory/{VonageExtensionNumber}', $params)); die();