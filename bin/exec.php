<?php

foreach ([__DIR__ . '/../autoload.php', __DIR__ . '/../vendor/autoload.php'] as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

$builder = new DI\ContainerBuilder();
$container = $builder->build();

$generator = $container->get('Wod\Generator');
$generator->generate();

