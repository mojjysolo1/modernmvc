<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf7b88b9651c92a5b58915c3bf7e505fd
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\EventLoop\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\EventLoop\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/event-loop/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf7b88b9651c92a5b58915c3bf7e505fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf7b88b9651c92a5b58915c3bf7e505fd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}