<?php

declare(strict_types=1);

namespace App\Service\Moviment;

use App\Entity\Moviment;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class InsertMovimentServiceFactory
{
    public function __invoke(ContainerInterface $container): InsertMovimentService
    {
        $entityManager = $container->get(EntityManager::class);
        $movimentRepository = $entityManager->getRepository(Moviment::class);
        return new InsertMovimentService($movimentRepository);
    }
}
