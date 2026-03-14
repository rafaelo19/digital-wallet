<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

#[ORM\Table(name: 'conta', schema: 'dw')]
#[ORM\Entity(repositoryClass: 'App\Repository\AccountRepository')]
class Account
{
    #[Type('int')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\SequenceGenerator(sequenceName: 'dw.conta_id_seq', allocationSize: 1, initialValue: 1)]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    protected $id;

    #[Type('string')]
    #[ORM\Column(name: 'nome', type: 'text', nullable: false)]
    protected $nome;

    #[Type('int')]
    #[ORM\Column(name: 'id_usuario', type: 'integer', nullable: true)]
    protected $idusuario;

    #[Type('float')]
    #[ORM\Column(name: 'saldo', type: 'float', nullable: false)]
    protected $saldo;

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

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getIdUsuario(): ?int
    {
        return $this->idusuario;
    }

    public function setIdUsuario(?int $idusuario): void
    {
        $this->idusuario = $idusuario;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
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
