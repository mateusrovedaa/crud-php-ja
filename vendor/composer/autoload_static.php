<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita7adb42a3f4a4cec6c06335c4f898d83
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita7adb42a3f4a4cec6c06335c4f898d83::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita7adb42a3f4a4cec6c06335c4f898d83::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInita7adb42a3f4a4cec6c06335c4f898d83::$prefixesPsr0;
            $loader->classMap = ComposerStaticInita7adb42a3f4a4cec6c06335c4f898d83::$classMap;

        }, null, ClassLoader::class);
    }
}
