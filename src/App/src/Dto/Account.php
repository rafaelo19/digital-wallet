<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Account
{
    #[Type('string')]
    protected $nome;

    #[Type('float')]
    protected $saldo;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('nome', new Assert\NotBlank(['message' => 'nome obrigatorio']));
        $metadata->addPropertyConstraint('saldo', new Assert\NotBlank(['message' => 'saldo obrigatorio']));
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
    }
}
