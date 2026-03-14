<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Exception;

class UserRepository extends EntityRepository
{
    /**
     * @throws Exception
     */
    public function get(int $id): ?User
    {
        try {
            return $this->findOneBy(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception('Erro ao tentar buscar usuario!', 500);
        }
    }

    /**
     * @throws Exception
     */
    public function getByEmail(string $email): ?User
    {
        try {
            return $this->findOneBy(['email' => $email]);
        } catch (Exception $e) {
            throw new Exception('Erro ao tentar buscar usuario!', 500);
        }
    }
}
