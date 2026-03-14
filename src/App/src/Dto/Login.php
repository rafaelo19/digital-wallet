<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Login
{
    #[Type('string')]
    #[SerializedName('email')]
    protected $email;

    #[Type('string')]
    #[SerializedName('senha')]
    protected $senha;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('email', new Assert\NotBlank(['message' => 'email obrigatorio']));
        $metadata->addPropertyConstraint('email', new Assert\Email(['message' => 'email invalido']));
        $metadata->addPropertyConstraint('senha', new Assert\NotBlank(['message' => 'senha obrigatoria']));
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }
}
