<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class LoginServiceFactory
{
    public function __invoke(ContainerInterface $container): LoginService
    {
        $entityManager = $container->get(EntityManager::class);
        $userRepository = $entityManager->getRepository(User::class);
        $jwtService = $container->get(JwtService::class);

        return new LoginService($userRepository, $jwtService);
    }
}
