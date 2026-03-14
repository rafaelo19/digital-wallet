<?php

declare(strict_types=1);

namespace App\Factory;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $config = $container->get('config');
        $doctrineConfig = $config['doctrine'];
        $paths = $doctrineConfig['orm']['metadata_paths'] ?? [];
        $connectionParams = $doctrineConfig['connection']['orm_default']['params'] ?? [];
        $isDevMode = (bool) ($config['debug'] ?? false);

        $doctrineSetup = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        return EntityManager::create($connectionParams, $doctrineSetup);
    }
}
