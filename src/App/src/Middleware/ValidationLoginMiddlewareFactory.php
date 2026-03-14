<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\Serializer;
use Psr\Container\ContainerInterface;

class ValidationLoginMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ValidationLoginMiddleware
    {
        $serializer = $container->get(Serializer::class);

        return new ValidationLoginMiddleware($serializer);
    }
}
