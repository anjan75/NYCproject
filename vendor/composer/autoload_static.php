<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3a98cbb2e980e4b9e82ce0c419cb67ed
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3a98cbb2e980e4b9e82ce0c419cb67ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3a98cbb2e980e4b9e82ce0c419cb67ed::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}