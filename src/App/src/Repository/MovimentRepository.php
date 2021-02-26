<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Moviment;
use App\Sqls\SelectMoviments;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityRepository;
use Exception;

class MovimentRepository extends EntityRepository
{
    /**
     * @var ResultSetMapping
     */
    private $resultSetMapping;

    private function setInstance()
    {
        $this->resultSetMapping = new ResultSetMapping();
    }
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

    /**
     * @param int $idAccount
     * @return array
     * @throws Exception
     */
    public function getMoviments(int $idAccount): array
    {
        try {
            $this->setInstance();
            $this->resultSetMapping->addScalarResult("id","id","integer");
            $this->resultSetMapping->addScalarResult("nome","nome","string");
            $this->resultSetMapping->addScalarResult("data","data","string");
            $this->resultSetMapping->addScalarResult("descricao","descricao","string");
            $this->resultSetMapping->addScalarResult("valor","valor","float");
            $query = $this->getEntityManager()->createNativeQuery(SelectMoviments::SELECT_MOVIMENTS_ACCOUNT,
                $this->resultSetMapping);
            $query->setParameter("id_conta", $idAccount);
            return $query->getResult();
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta buscar movimentos da conta!", 500);
        }
    }
}
