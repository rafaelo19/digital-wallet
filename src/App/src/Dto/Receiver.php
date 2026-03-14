<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Receiver
{
    #[Type('int')]
    #[SerializedName('id_conta')]
    protected $idconta;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint(
            'idconta',
            new Assert\NotBlank(['message' => 'destinatario: id_conta obrigatorio'])
        );
    }

    public function getIdconta(): int
    {
        return $this->idconta;
    }

    public function setIdconta(int $idconta): void
    {
        $this->idconta = $idconta;
    }
}
