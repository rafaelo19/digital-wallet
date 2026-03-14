<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Auth\LoginService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $loginService = $container->get(LoginService::class);

        return new LoginHandler($loginService);
    }
}
