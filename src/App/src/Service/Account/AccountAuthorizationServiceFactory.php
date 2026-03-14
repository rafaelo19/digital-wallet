<?php

declare(strict_types=1);

namespace App\Service\Account;

use App\Entity\Account;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class AccountAuthorizationServiceFactory
{
    public function __invoke(ContainerInterface $container): AccountAuthorizationService
    {
        $entityManager = $container->get(EntityManager::class);
        $accountRepository = $entityManager->getRepository(Account::class);

        return new AccountAuthorizationService($accountRepository);
    }
}
