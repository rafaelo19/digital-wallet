<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Moviment
{
    #[Type('int')]
    #[SerializedName('id_conta')]
    protected $idconta;

    #[Type('float')]
    #[SerializedName('valor')]
    protected $valor;

    #[Type('int')]
    #[SerializedName('id_tipo_movimento')]
    protected $idtipomovimento;

    #[Type('string')]
    #[SerializedName('descricao')]
    protected $descricao;

    #[Type(Receiver::class)]
    protected $destinatario;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $requiredForAll = ['groups' => ['dep', 'sqe', 'trs']];

        $metadata->addPropertyConstraint('idconta', new Assert\NotBlank($requiredForAll + ['message' => 'id_conta obrigatorio']));
        $metadata->addPropertyConstraint('valor', new Assert\NotBlank($requiredForAll + ['message' => 'valor obrigatorio']));
        $metadata->addPropertyConstraint('idtipomovimento', new Assert\NotBlank($requiredForAll + ['message' => 'id_tipo_movimento obrigatorio']));
        $metadata->addPropertyConstraint('descricao', new Assert\NotBlank($requiredForAll + ['message' => 'descricao obrigatorio']));
        $metadata->addPropertyConstraint(
            'destinatario',
            new Assert\NotBlank(['groups' => ['trs'], 'message' => 'destinatario obrigatorio'])
        );
    }

    public function getIdConta(): int
    {
        return $this->idconta;
    }

    public function setIdConta(int $idconta): void
    {
        $this->idconta = $idconta;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getIdTipoMovimento(): int
    {
        return $this->idtipomovimento;
    }

    public function setIdTipoMovimento(int $idtipomovimento): void
    {
        $this->idtipomovimento = $idtipomovimento;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getDestinatario(): Receiver
    {
        return $this->destinatario;
    }

    public function setDestinatario(Receiver $destinatario): void
    {
        $this->destinatario = $destinatario;
    }
}
