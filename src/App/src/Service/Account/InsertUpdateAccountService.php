<?php

declare(strict_types=1);

namespace App\Service\Account;

use Exception;
use App\Entity\Account;
use App\Repository\AccountRepository;

class InsertUpdateAccountService
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
     * @param Account $account
     * @return Account
     * @throws Exception
     */
    public function insertUpdate(Account $account): Account
    {
        return $this->accountRepository->insertUpdate($account);
    }
}
