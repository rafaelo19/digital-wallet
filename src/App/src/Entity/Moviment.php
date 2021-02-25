<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use DateTime;

/**
 * @ORM\Table(schema="dw", name="movimento")
 * @ORM\Entity(repositoryClass="App\Repository\MovimentRepository")
 */
class Moviment
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="dw.movimento_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var int
     * @Type("int")
     * @ORM\Column(name="id_tipo_movimento", type="integer", nullable=false)
     */
    protected $idtipomovimento;

    /**
     * @var int
     * @Type("int")
     * @ORM\Column(name="id_conta_origem", type="integer", nullable=false)
     */
    protected $idcontaorigem;

    /**
     * @var int
     * @Type("int")
     * @ORM\Column(name="id_conta_destino", type="integer", nullable=false)
     */
    protected $idcontadestino;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    protected $descricao;

    /**
     * @var float
     * @Type("float")
     * @ORM\Column(name="valor", type="decimal", nullable=false)
     */
    protected $valor;

    /**
     * @var DateTime
     * @Type("DateTime<d/m/Y H:i:s>")
     * @ORM\Column(name="datahora", type="datetime", nullable=false)
     */
    protected $datahora;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdTipoMovimento(): int
    {
        return $this->idtipomovimento;
    }

    /**
     * @param int $idtipomovimento
     */
    public function setIdTipoMovimento(int $idtipomovimento): void
    {
        $this->idtipomovimento = $idtipomovimento;
    }

    /**
     * @return int
     */
    public function getIdContaOrigem(): int
    {
        return $this->idcontaorigem;
    }

    /**
     * @param int $idcontaorigem
     */
    public function setIdContaOrigem(int $idcontaorigem): void
    {
        $this->idcontaorigem = $idcontaorigem;
    }

    /**
     * @return int
     */
    public function getIdContaDestino(): int
    {
        return $this->idcontadestino;
    }

    /**
     * @param int $idcontadestino
     */
    public function setIdContaDestino(int $idcontadestino): void
    {
        $this->idcontadestino = $idcontadestino;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     */
    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    /**
     * @return DateTime
     */
    public function getDataHora(): DateTime
    {
        return $this->datahora;
    }

    /**
     * @param DateTime $datahora
     */
    public function setDataHora(DateTime $datahora): void
    {
        $this->datahora = $datahora;
    }

}
