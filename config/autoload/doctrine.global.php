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
                    'host' => 'database',
                    'port' => '5432',
                    'user' => 'admin',
                    'password' => 'admin',
                    'dbname' => 'digital-wallet'
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
