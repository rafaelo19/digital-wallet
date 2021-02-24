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
    public function insert(Account $account): Account
    {
        try {
            $this->getEntityManager()->persist($account);
            $this->getEntityManager()->flush();
            return $account;
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
            throw new Exception("Erro ao tenta salvar registro!", 500);
        }

    }

    /**
     * @param Account $account
     * @return Account
     * @throws Exception
     */
    public function update(Account $account): Account
    {
        try {
            $this->getEntityManager()->persist($account);
            $this->getEntityManager()->flush();
            return $account;
        } catch (Exception $e) {
            throw new Exception("Erro ao tenta alterar registro!", 500);
        }

    }
}
