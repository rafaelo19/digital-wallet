<?php

declare(strict_types=1);

namespace App\Service\MakeMoviment;

use App\Dto\Moviment as MovimentDto;
use App\Entity\Account;
use App\Entity\TypeMoviment;
use App\Service\Account\GetAccountService;
use App\Service\TypeMoviment\GetTypeMovimentService;
use Exception;

class ValidationDataMoviment
{
    /**
     * @var GetTypeMovimentService
     */
    private $getTypeMovimentService;

    /**
     * @var GetAccountService
     */
    private $getAccountService;

    /**
     * @var array
     */
    private $typesMovimentConfig;

    /**
     * @var MovimentDto
     */
    private $movimentDto;

    /**
     * @var TypeMoviment
     */
    private $typeMoviment;

    /**
     * @var Account
     */
    private $account;

    public function __construct(GetTypeMovimentService $getTypeMovimentService,
                                GetAccountService $getAccountService,
                                array $typesMovimentConfig)
    {
        $this->getTypeMovimentService = $getTypeMovimentService;
        $this->getAccountService = $getAccountService;
        $this->typesMovimentConfig = $typesMovimentConfig;
    }

    /**
     * @param MovimentDto $movimentDto
     * @throws Exception
     */
    public function validation(MovimentDto $movimentDto)
    {
        $this->movimentDto = $movimentDto;
        $this->account = $this->getAccountService->get($movimentDto->getIdConta());
        $this->typeMoviment = $this->getTypeMovimentService->get($movimentDto->getIdTipoMovimento());

        $this->validateExistTypeMoviment();
        $this->validateExistAccount();
        $this->validateValuesSub();
    }

    /**
     * @throws Exception
     */
    private function validateExistTypeMoviment():void
    {
        if (!$this->typeMoviment) {
            throw new Exception("id_tipo_movimento {$this->movimentDto->getIdTipoMovimento()} não encontrado!");
        }
    }

    /**
     * @throws Exception
     */
    private function validateExistAccount(): void
    {
        if (!$this->account) {
            throw new Exception("id_conta {$this->movimentDto->getIdConta()} não encontrado!");
        }
        if (!$this->account->isStatus()) {
            throw new Exception("conta {$this->movimentDto->getIdConta()} está desativada pra movimentações!");
        }
    }

    /**
     * @throws Exception
     */
    private function validateValuesSub(): void
    {
        if ($this->movimentDto->getIdTipoMovimento() != $this->typesMovimentConfig['dep']) {
            $this->validateDataReceiver();
            $this->validateValuePrice();
        }
    }

    /**
     * @throws Exception
     */
    private function validateDataReceiver(): void
    {
        if ($this->movimentDto->getIdTipoMovimento() == $this->typesMovimentConfig['trs']) {
            $idAccount= $this->movimentDto->getDestinatario()->getIdconta();
            $account = $this->getAccountService->get($idAccount);
            if (!$account) {
                throw new Exception("id_conta destinatario {$idAccount} não encontrado!");
            }
            $idContaDestinatario = $this->movimentDto->getDestinatario()->getIdconta();
            if(!$account->isStatus()) {
                throw new Exception("conta do destinatario {$idContaDestinatario} está desativada pra movimentações!");
            }
        }
    }

    /**
     * @throws Exception
     */
    private function validateValuePrice(): void
    {
        if ($this->movimentDto->getValor() > $this->account->getSaldo()) {
            throw new Exception("Saldo insuficiente para realizar processo de movimentação!");
        }
    }

}
