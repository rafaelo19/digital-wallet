<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class Moviment
{
    /**
     * @var int
     * @Type("int")
     * @SerializedName("id_conta")
     * @Assert\NotBlank(groups={"dep", "sqe", "trs"}, message="id_conta obrigatório")
     */
    protected $idconta;

    /**
     * @var float
     * @Type("float")
     * @SerializedName("valor")
     * @Assert\NotBlank(groups={"dep", "sqe", "trs"}, message="valor obrigatório")
     */
    protected $valor;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("id_tipo_movimento")
     * @Assert\NotBlank(groups={"dep", "sqe", "trs"}, message="id_tipo_movimento obrigatório")
     */
    protected $idtipomovimento;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("descricao")
     * @Assert\NotBlank(groups={"dep", "sqe", "trs"}, message="descricao obrigatório")
     */
    protected $descricao;

    /**
     * @var Receiver
     * @Type("App\Dto\Receiver")
     * @Assert\NotBlank(groups={"trs"}, message="destinatario obrigatório")
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
