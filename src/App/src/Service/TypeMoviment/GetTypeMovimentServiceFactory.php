<?php

declare(strict_types=1);

namespace App\Service\TypeMoviment;

use App\Entity\TypeMoviment;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class GetTypeMovimentServiceFactory
{
    public function __invoke(ContainerInterface $container): GetTypeMovimentService
    {
        $entityManager = $container->get(EntityManager::class);
        $typeMovimentRepository = $entityManager->getRepository(TypeMoviment::class);
        return new GetTypeMovimentService($typeMovimentRepository);
    }
}
