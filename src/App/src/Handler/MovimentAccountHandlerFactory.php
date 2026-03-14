<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\MakeMoviment\MovimentService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MovimentAccountHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $movimentService = $container->get(MovimentService::class);
        return new MovimentAccountHandler($movimentService);
    }
}
