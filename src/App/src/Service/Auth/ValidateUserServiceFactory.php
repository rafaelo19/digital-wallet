<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ValidateUserServiceFactory
{
    public function __invoke(ContainerInterface $container): ValidateUserService
    {
        $entityManager = $container->get(EntityManager::class);
        $userRepository = $entityManager->getRepository(User::class);

        return new ValidateUserService($userRepository);
    }
}
