<?php

declare(strict_types=1);

namespace App\Service\Account;

use Doctrine\ORM\EntityManager;
use App\Entity\Account;
use Psr\Container\ContainerInterface;

class InsertUpdateAccountServiceFactory
{
    public function __invoke(ContainerInterface $container): InsertUpdateAccountService
    {
        $entityManager = $container->get(EntityManager::class);
        $accountRepository = $entityManager->getRepository(Account::class);
        return new InsertUpdateAccountService($accountRepository);
    }
}
