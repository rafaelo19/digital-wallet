<?php

declare(strict_types=1);

namespace App\Service\MakeMoviment;

use App\Service\Account\AccountAuthorizationService;
use App\Service\Account\GetAccountService;
use App\Service\TypeMoviment\GetTypeMovimentService;
use Psr\Container\ContainerInterface;

class ValidationDataMovimentFactory
{
    public function __invoke(ContainerInterface $container): ValidationDataMoviment
    {
        $getTypeMovimentService = $container->get(GetTypeMovimentService::class);
        $getAccountService = $container->get(GetAccountService::class);
        $accountAuthorizationService = $container->get(AccountAuthorizationService::class);
        $typesMovimentConfig = $container->get('config')['types-moviment'];
        return new ValidationDataMoviment($getTypeMovimentService,
            $getAccountService,
            $accountAuthorizationService,
            $typesMovimentConfig);
    }

}
