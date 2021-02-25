<?php

declare(strict_types=1);

namespace App\Service\MakeMoviment;

use App\Dto\Moviment as MovimentDto;
use App\Entity\Moviment;
use App\Service\Account\GetAccountService;
use App\Service\Account\InsertUpdateAccountService;
use App\Service\Moviment\InsertMovimentService;
use Doctrine\ORM\EntityManager;
use Exception;

class MovimentService
{
    /**
     * @var MovimentDto
     */
    private $movimentDto;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var GetAccountService
     */
    private $getAccountService;

    /**
     * @var InsertUpdateAccountService
     */
    private $insertAccountService;

    /**
     * @var InsertMovimentService
     */
    private $insertMoviment;

    /**
     * @var array
     */
    private $typesMovimentConfig;

    public function __construct(EntityManager $entityManager,
                                GetAccountService $getAccountService,
                                InsertUpdateAccountService $insertAccountService,
                                InsertMovimentService $insertMoviment,
                                array $typesMovimentConfig)
    {
        $this->entityManager = $entityManager;
        $this->getAccountService = $getAccountService;
        $this->insertAccountService = $insertAccountService;
        $this->insertMoviment = $insertMoviment;
        $this->typesMovimentConfig = $typesMovimentConfig;
    }

    /**
     * @param MovimentDto $movimentDto
     * @throws Exception
     */
    public function makeMoviment(MovimentDto $movimentDto): void
    {
        $this->movimentDto = $movimentDto;
        $this->entityManager->beginTransaction();
        $this->updateAccount();
        $this->insertMoviment();
        $this->entityManager->commit();
    }

    public function updateAccount():void
    {
        $account = $this->getAccountService->get($this->movimentDto->getIdConta());
        if ($this->movimentDto->getIdTipoMovimento() == $this->typesMovimentConfig['dep']) {
            $value = $account->getSaldo() + $this->movimentDto->getValor();
        } else {
            $value = $account->getSaldo() - $this->movimentDto->getValor();
        }
        $account->setSaldo($value);
        $this->insertAccountService->insertUpdate($account);
    }

    private function insertMoviment(): void
    {
        $moviment = new Moviment();
        $moviment->setIdContaOrigem($this->movimentDto->getIdConta());
        $moviment->setDescricao($this->movimentDto->getDescricao());
        $moviment->setValor($this->movimentDto->getValor());
        $moviment->setDataHora(new \DateTime('now'));
        if ($this->movimentDto->getIdTipoMovimento() == $this->typesMovimentConfig['trs']) {
            $moviment->setIdContaDestino($this->movimentDto->getDestinatario()->getIdconta());
            $this->movimentTransfer();
        }
        $moviment->setIdTipoMovimento($this->movimentDto->getIdTipoMovimento());
        $this->insertMoviment->insert($moviment);
    }

    private function movimentTransfer(): void
    {
        $account = $this->getAccountService->get($this->movimentDto->getDestinatario()->getIdconta());
        $value = $account->getSaldo() + $this->movimentDto->getValor();
        $account->setSaldo($value);
        $this->insertAccountService->insertUpdate($account);
    }
}