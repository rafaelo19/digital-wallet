<?php

declare(strict_types=1);

use Doctrine\DBAL\Driver\PDO\PgSQL\Driver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverClass' => Driver::class,
                    'driverOptions' => [PDO::ATTR_EMULATE_PREPARES => true],
                    'charset' => 'utf8',
                    'host' => getenv("DATABASE_HOST"),
                    'port' => getenv("DATABASE_PORT"),
                    'user' => getenv("DATABASE_USER"),
                    'password' => getenv("DATABASE_PASSWORD"),
                    'dbname' => getenv("DATABASE_NAME"),
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'app_entity',
                ],
            ],
            'app_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/App/src/Entity'],
            ],
        ],
    ]
];
