<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\MakeMoviment\MovimentService;
use App\Util\Serializer;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MovimentAccountHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $serializer = $container->get(Serializer::class);
        $movimentService = $container->get(MovimentService::class);
        return new MovimentAccountHandler($serializer, $movimentService);
    }
}
