<?php

declare(strict_types=1);

namespace App\Service\Account;

use Exception;
use App\Entity\Account;
use App\Repository\AccountRepository;
use App\Dto\Account as AccountDto;

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
     * @param AccountDto $accountDto
     * @return Account
     * @throws Exception
     */
    public function insertAccount(AccountDto $accountDto): Account
    {
        $account = new Account();
        $account->setNome($accountDto->getNome());
        $account->setSaldo($accountDto->getSaldo());
        $account->setStatus(true);
        return $this->insertUpdate($account);
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
