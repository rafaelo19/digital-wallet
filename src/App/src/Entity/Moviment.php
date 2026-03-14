<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

#[ORM\Table(name: 'movimento', schema: 'dw')]
#[ORM\Entity(repositoryClass: 'App\Repository\MovimentRepository')]
class Moviment
{
    #[Type('int')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\SequenceGenerator(sequenceName: 'dw.movimento_id_seq', allocationSize: 1, initialValue: 1)]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    protected $id;

    #[Type('int')]
    #[ORM\Column(name: 'id_tipo_movimento', type: 'integer', nullable: false)]
    protected $idtipomovimento;

    #[Type('int')]
    #[ORM\Column(name: 'id_conta_origem', type: 'integer', nullable: false)]
    protected $idcontaorigem;

    #[Type('int')]
    #[ORM\Column(name: 'id_conta_destino', type: 'integer', nullable: false)]
    protected $idcontadestino;

    #[Type('string')]
    #[ORM\Column(name: 'descricao', type: 'text', nullable: false)]
    protected $descricao;

    #[Type('float')]
    #[ORM\Column(name: 'valor', type: 'decimal', nullable: false)]
    protected $valor;

    #[Type('DateTime<d/m/Y H:i:s>')]
    #[ORM\Column(name: 'datahora', type: 'datetime', nullable: false)]
    protected $datahora;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdTipoMovimento(): int
    {
        return $this->idtipomovimento;
    }

    public function setIdTipoMovimento(int $idtipomovimento): void
    {
        $this->idtipomovimento = $idtipomovimento;
    }

    public function getIdContaOrigem(): int
    {
        return $this->idcontaorigem;
    }

    public function setIdContaOrigem(int $idcontaorigem): void
    {
        $this->idcontaorigem = $idcontaorigem;
    }

    public function getIdContaDestino(): int
    {
        return $this->idcontadestino;
    }

    public function setIdContaDestino(int $idcontadestino): void
    {
        $this->idcontadestino = $idcontadestino;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getDataHora(): DateTime
    {
        return $this->datahora;
    }

    public function setDataHora(DateTime $datahora): void
    {
        $this->datahora = $datahora;
    }
}
