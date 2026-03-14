<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driver' => 'pdo_pgsql',
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
        'orm' => [
            'metadata_paths' => [__DIR__ . '/../../src/App/src/Entity'],
        ],
    ]
];
