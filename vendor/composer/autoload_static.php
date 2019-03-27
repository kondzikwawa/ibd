<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f591035d6d092acbdda7cc03a38d8d1
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Ibd\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ibd\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f591035d6d092acbdda7cc03a38d8d1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f591035d6d092acbdda7cc03a38d8d1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
