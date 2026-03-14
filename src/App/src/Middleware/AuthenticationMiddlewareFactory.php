<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\Auth\JwtService;
use App\Service\Auth\ValidateUserService;
use Psr\Container\ContainerInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        $jwtService = $container->get(JwtService::class);
        $validateUserService = $container->get(ValidateUserService::class);

        return new AuthenticationMiddleware($jwtService, $validateUserService);
    }
}
