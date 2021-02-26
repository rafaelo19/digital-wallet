<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Moviment\GetMovimentService;
use Psr\Container\ContainerInterface;

class GetMovimentAccountHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetMovimentAccountHandler
    {
        $getMovimentService = $container->get(GetMovimentService::class);
        return new GetMovimentAccountHandler($getMovimentService);
    }
}
