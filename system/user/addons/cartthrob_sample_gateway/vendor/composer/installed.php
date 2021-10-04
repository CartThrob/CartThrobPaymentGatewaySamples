<?php return array(
    'root' => array(
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => '9af6b904539cb868d6493243dec081390677f993',
        'name' => 'cartthrob/cartthrob_sample_gateway',
        'dev' => true,
    ),
    'versions' => array(
        'cartthrob/cartthrob_sample_gateway' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => '9af6b904539cb868d6493243dec081390677f993',
            'dev_requirement' => false,
        ),
        'omnipay/common' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'omnipay/dummy' => array(
            'pretty_version' => 'v3.0.0',
            'version' => '3.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../omnipay/dummy',
            'aliases' => array(),
            'reference' => 'bfddc1e3127b7df41a5291213b314fdb4c66f6a2',
            'dev_requirement' => false,
        ),
    ),
);
