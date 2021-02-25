<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class Account
{
    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank(message="nome obrigatório")
     */
    protected $nome;

    /**
     * @var float
     * @Type("float")
     * @Assert\NotBlank(message="saldo obrigatório")
     */
    protected $saldo;

    /**
     * @var bool
     * @Type("bool")
     * @Assert\NotBlank(message="status obrigatório")
     */
    protected $status;

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return float
     */
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    /**
     * @param float $saldo
     */
    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
