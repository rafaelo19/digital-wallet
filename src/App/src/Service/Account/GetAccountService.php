<?php

declare(strict_types=1);

namespace App\Service\Account;

use Exception;
use App\Entity\Account;
use App\Repository\AccountRepository;

class GetAccountService
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
     * @param int $id
     * @return Account
     * @throws Exception
     */
    public function get(int $id): Account
    {
        return $this->accountRepository->get($id);
    }
}
