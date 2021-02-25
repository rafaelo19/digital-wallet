<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Account\InsertUpdateAccountService;
use App\Util\Serializer;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AccountHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $serializer = $container->get(Serializer::class);
        $insertUpdateAccountService = $container->get(InsertUpdateAccountService::class);
        return new AccountHandler($serializer, $insertUpdateAccountService);
    }
}
