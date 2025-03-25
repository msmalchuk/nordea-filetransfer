<?php

require_once __DIR__ . '/../vendor/autoload.php';

$key_file = realpath(__DIR__ . '/../cert/privatekey.pem');
$cert_file = realpath(__DIR__ . '/../cert/certificate.pem');

$config = new \Profit\Nordea\API\Config();
$config->language = 'EN';
$config->environment = 'PRODUCTION';
$config->user_agent = 'PHP';
$config->software_id = 'NordeaTest';
$config->cert_file = $cert_file;
$config->private_key_file = $key_file;
$config->sender_id = 11111111;
$config->customer_id = 162355330;
$config->receiver_id = 123456789;