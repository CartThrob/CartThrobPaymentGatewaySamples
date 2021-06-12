<?php

require_once __DIR__ . '/vendor/autoload.php';

define('CARTTHROB_SAMPLE_GATEWAY_NAME', 'CartThrob Sample Payment Gateway');
define('CARTTHROB_SAMPLE_GATEWAY_VERSION', '0.0.1');
define('CARTTHROB_SAMPLE_GATEWAY_DESC', 'An example implementation of a Payment Gateway for CartThrob');

return [
    'author' => 'Foster Made',
    'author_url' => 'https://cartthrob.com',
    'docs_url' => '',
    'name' => CARTTHROB_SAMPLE_GATEWAY_NAME,
    'description' => CARTTHROB_SAMPLE_GATEWAY_DESC,
    'version' => CARTTHROB_SAMPLE_GATEWAY_VERSION,
    'namespace' => 'CartThrob\SampleGateway',
    'settings_exist' => false,
];