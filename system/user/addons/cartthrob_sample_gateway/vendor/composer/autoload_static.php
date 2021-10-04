<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit90a4fc4954178474955b8c8c890a82b9
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Omnipay\\Dummy\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Omnipay\\Dummy\\' => 
        array (
            0 => __DIR__ . '/..' . '/omnipay/dummy/src',
        ),
    );

    public static $classMap = array (
        'Cartthrob_sample_gateway' => __DIR__ . '/../..' . '/src/Cartthrob_sample_gateway.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit90a4fc4954178474955b8c8c890a82b9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit90a4fc4954178474955b8c8c890a82b9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit90a4fc4954178474955b8c8c890a82b9::$classMap;

        }, null, ClassLoader::class);
    }
}
