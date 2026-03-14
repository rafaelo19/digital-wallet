<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

#[ORM\Table(name: 'tipo_movimento', schema: 'dw')]
#[ORM\Entity(repositoryClass: 'App\Repository\TypeMovimentRepository')]
class TypeMoviment
{
    #[Type('int')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\SequenceGenerator(sequenceName: 'dw.conta_id_seq', allocationSize: 1, initialValue: 1)]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    protected $id;

    #[Type('string')]
    #[ORM\Column(name: 'cod', type: 'text', nullable: false)]
    protected $cod;

    #[Type('string')]
    #[ORM\Column(name: 'descricao', type: 'text', nullable: false)]
    protected $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCod(): string
    {
        return $this->cod;
    }

    public function setCod(string $cod): void
    {
        $this->cod = $cod;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
}
