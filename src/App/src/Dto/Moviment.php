<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Moviment
{
    /**
     * @var int
     * @Type("int")
     * @SerializedName("id_conta")
     */
    protected $idconta;

    /**
     * @var float
     * @Type("float")
     * @SerializedName("valor")
     */
    protected $valor;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("id_tipo_movimento")
     */
    protected $idtipomovimento;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("descricao")
     */
    protected $descricao;

    /**
     * @var Receiver
     * @Type("App\Dto\Receiver")
     */
    protected $destinatario;

    /**
     * @return int
     */
    public function getIdConta(): int
    {
        return $this->idconta;
    }

    /**
     * @param int $idconta
     */
    public function setIdConta(int $idconta): void
    {
        $this->idconta = $idconta;
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
     * @return Receiver
     */
    public function getDestinatario(): Receiver
    {
        return $this->destinatario;
    }

    /**
     * @param Receiver $destinatario
     */
    public function setDestinatario(Receiver $destinatario): void
    {
        $this->destinatario = $destinatario;
    }
}
