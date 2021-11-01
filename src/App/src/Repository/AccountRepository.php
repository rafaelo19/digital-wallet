<?php

declare(strict_types=1);

namespace App\Repository;

use Exception;
use App\Entity\Account;
use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
    /**
     * @param Account $account
     * @return Account
     * @throws Exception
     */
    public function insertUpdate(Account $account): Account
    {
        try {
            $this->getEntityManager()->persist($account);
            $this->getEntityManager()->flush();
            return $account;
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta salvar conta! {$e->getMessage()}", 500);
        }

    }

    /**
     * @param int $id
     * @return Account|null|object
     * @throws Exception
     */
    public function get(int $id): ?Account
    {
        try {
            return $this->findOneBy(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta buscar conta!", 500);
        }

    }
}
