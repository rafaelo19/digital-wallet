<?php

declare(strict_types=1);

namespace App\Util;

use Psr\Container\ContainerInterface;

class SerializerFactory
{
    public function __invoke(ContainerInterface $container): Serializer
    {
        return new Serializer();
    }

}
