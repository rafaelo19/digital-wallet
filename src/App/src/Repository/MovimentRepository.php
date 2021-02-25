<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Moviment;
use Exception;
use Doctrine\ORM\EntityRepository;

class MovimentRepository extends EntityRepository
{
    /**
     * @param Moviment $moviment
     * @return Moviment
     * @throws Exception
     */
    public function insert(Moviment $moviment): Moviment
    {
        try {
            $this->getEntityManager()->persist($moviment);
            $this->getEntityManager()->flush();
            return $moviment;
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta salvar movimento!", 500);
        }
    }
}
