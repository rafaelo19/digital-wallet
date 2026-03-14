<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Dto\Login;
use App\Repository\UserRepository;
use Exception;

class LoginService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var JwtService
     */
    private $jwtService;

    public function __construct(UserRepository $userRepository, JwtService $jwtService)
    {
        $this->userRepository = $userRepository;
        $this->jwtService = $jwtService;
    }

    /**
     * @throws Exception
     */
    public function login(Login $loginDto): array
    {
        $user = $this->userRepository->getByEmail($loginDto->getEmail());

        if (!$user || !password_verify($loginDto->getSenha(), $user->getSenha())) {
            throw new Exception('Credenciais invalidas!', 401);
        }

        if (!$user->isStatus()) {
            throw new Exception('Usuario desativado!', 403);
        }

        return $this->jwtService->generateToken($user);
    }
}
