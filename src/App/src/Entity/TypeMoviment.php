<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Table(schema="dw", name="tipo_movimento")
 * @ORM\Entity(repositoryClass="App\Repository\TypeMovimentRepository")
 */
class TypeMoviment
{
    /**
     * @var int
     * @Type("int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="dw.conta_id_seq", allocationSize=1, initialValue=1)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="cod", type="text", nullable=false)
     */
    protected $cod;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    protected $descricao;

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
     * @return string
     */
    public function getCod(): string
    {
        return $this->cod;
    }

    /**
     * @param string $cod
     */
    public function setCod(string $cod): void
    {
        $this->cod = $cod;
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

}
