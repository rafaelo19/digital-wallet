<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use App\Repository\UserRepository;
use Exception;

class ValidateUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function getActiveUser(int $idUser): User
    {
        $user = $this->userRepository->get($idUser);

        if (!$user) {
            throw new Exception('Usuario autenticado nao encontrado!', 401);
        }

        if (!$user->isStatus()) {
            throw new Exception('Usuario autenticado esta desativado!', 403);
        }

        return $user;
    }
}
