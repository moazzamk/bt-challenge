<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/vendor/autoload.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([ __DIR__ . '/src' ], $isDevMode, null, null, false);
$conn = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/data/cc.db'
];

$entityManager = EntityManager::create($conn, $config);

$container = new \League\Container\Container();
$container->share('EntityManager', $entityManager);
$services = require_once __DIR__ . '/config/services.php';
foreach ($services as $name=>$definition) {
    $container->share($name, function () use ($container, $definition) {
        return $definition($container);
    });
}