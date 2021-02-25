<?php

declare(strict_types=1);

namespace App\Service\MakeMoviment;

use App\Service\Account\GetAccountService;
use App\Service\Account\InsertUpdateAccountService;
use App\Service\Moviment\InsertMovimentService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class MovimentServiceFactory
{
    public function __invoke(ContainerInterface $container): MovimentService
    {
        $entityManager = $container->get(EntityManager::class);
        $getAccountService = $container->get(GetAccountService::class);
        $insertAccountService = $container->get(InsertUpdateAccountService::class);
        $insertMoviment = $container->get(InsertMovimentService::class);
        $typesMovimentConfig = $container->get('config')['types-moviment'];
        return new MovimentService($entityManager,
            $getAccountService,
            $insertAccountService,
            $insertMoviment,
            $typesMovimentConfig);
    }

}
