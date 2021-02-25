<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Util\Serializer;
use Psr\Container\ContainerInterface;

class ValidationAccountMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ValidationAccountMiddleware
    {
        $serializer = $container->get(Serializer::class);
        return new ValidationAccountMiddleware($serializer);
    }
}
