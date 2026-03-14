<?php

declare(strict_types=1);

namespace App\Service\Account;

use App\Repository\AccountRepository;
use Exception;

class AccountAuthorizationService
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @throws Exception
     */
    public function ensureOwnership(int $idAccount, int $idUser): void
    {
        $account = $this->accountRepository->getByIdAndUser($idAccount, $idUser);

        if (!$account) {
            throw new Exception('Usuario nao possui acesso a conta informada!', 403);
        }
    }
}
