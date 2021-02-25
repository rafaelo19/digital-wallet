<?php

declare(strict_types=1);

namespace App\Service\MakeMoviment;

use App\Service\Account\GetAccountService;
use App\Service\Account\InsertUpdateAccountService;
use App\Service\Moviment\InsertMovimentService;
use App\Service\TypeMoviment\GetTypeMovimentService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ValidationDataMovimentFactory
{
    public function __invoke(ContainerInterface $container): ValidationDataMoviment
    {
        $getTypeMovimentService = $container->get(GetTypeMovimentService::class);
        $getAccountService = $container->get(GetAccountService::class);
        $typesMovimentConfig = $container->get('config')['types-moviment'];
        return new ValidationDataMoviment($getTypeMovimentService,
            $getAccountService,
            $typesMovimentConfig);
    }

}

