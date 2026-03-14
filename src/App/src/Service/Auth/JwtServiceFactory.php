<?php

declare(strict_types=1);

namespace App\Service\Auth;

use Psr\Container\ContainerInterface;

class JwtServiceFactory
{
    public function __invoke(ContainerInterface $container): JwtService
    {
        $config = $container->get('config');
        $securityConfig = $config['security'] ?? [];
        $secret = $securityConfig['jwt_secret'] ?? '';
        $ttl = (int) ($securityConfig['jwt_ttl'] ?? 300);

        return new JwtService($secret, $ttl);
    }
}
