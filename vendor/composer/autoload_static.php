<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita66b68eb55a42680c0abc80d8aa6d1c4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita66b68eb55a42680c0abc80d8aa6d1c4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita66b68eb55a42680c0abc80d8aa6d1c4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita66b68eb55a42680c0abc80d8aa6d1c4::$classMap;

        }, null, ClassLoader::class);
    }
}
