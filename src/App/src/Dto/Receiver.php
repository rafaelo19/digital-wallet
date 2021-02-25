<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Receiver
{
    /**
     * @var int
     * @Type("int")
     * @SerializedName("id_conta")
     */
    protected $idconta;

    /**
     * @return int
     */
    public function getIdconta(): int
    {
        return $this->idconta;
    }

    /**
     * @param int $idconta
     */
    public function setIdconta(int $idconta): void
    {
        $this->idconta = $idconta;
    }
}
