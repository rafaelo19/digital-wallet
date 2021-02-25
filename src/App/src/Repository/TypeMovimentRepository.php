<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TypeMoviment;
use Exception;
use Doctrine\ORM\EntityRepository;

class TypeMovimentRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return TypeMoviment|null|object
     * @throws Exception
     */
    public function get(int $id): ?TypeMoviment
    {
        try {
            return$this->findOneBy(["id" => $id]);
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta buscar tipo movimento!", 500);
        }
    }
}
