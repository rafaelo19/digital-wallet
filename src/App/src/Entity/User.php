<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

#[ORM\Table(name: 'usuario', schema: 'dw')]
#[ORM\Entity(repositoryClass: 'App\Repository\UserRepository')]
class User
{
    #[Type('int')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\SequenceGenerator(sequenceName: 'dw.usuario_id_seq', allocationSize: 1, initialValue: 1)]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    protected $id;

    #[Type('string')]
    #[ORM\Column(name: 'email', type: 'text', nullable: false, unique: true)]
    protected $email;

    #[ORM\Column(name: 'senha', type: 'text', nullable: false)]
    protected $senha;

    #[Type('bool')]
    #[ORM\Column(name: 'status', type: 'boolean', nullable: false)]
    protected $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
