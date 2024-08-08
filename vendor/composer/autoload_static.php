<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc82b30b145f7943c89f16871c16a0357
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Orbit\\TeamMember\\' => 17,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Orbit\\TeamMember\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\Plugin' => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src/Plugin.php',
        'Orbit\\TeamMember\\Admin\\CPT\\CPT' => __DIR__ . '/../..' . '/includes/Admin/CPT/CPT.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc82b30b145f7943c89f16871c16a0357::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc82b30b145f7943c89f16871c16a0357::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc82b30b145f7943c89f16871c16a0357::$classMap;

        }, null, ClassLoader::class);
    }
}