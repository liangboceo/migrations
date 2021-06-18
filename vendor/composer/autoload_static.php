<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit314627fc8e4c59333620a5f772dfbf2c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phinx\\' => 6,
        ),
        'J' => 
        array (
            'Jackson\\DivaTools\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phinx\\' => 
        array (
            0 => __DIR__ . '/../..' . '/phinx/src/Phinx',
        ),
        'Jackson\\DivaTools\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit314627fc8e4c59333620a5f772dfbf2c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit314627fc8e4c59333620a5f772dfbf2c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit314627fc8e4c59333620a5f772dfbf2c::$classMap;

        }, null, ClassLoader::class);
    }
}
