<?php

declare(strict_types=1);

namespace App\Service\Moviment;

use Exception;
use App\Entity\Moviment;
use App\Repository\MovimentRepository;

class InsertMovimentService
{
    /**
     * @var MovimentRepository
     */
    private $movimentRepository;

    public function __construct(MovimentRepository $movimentRepository)
    {
        $this->movimentRepository = $movimentRepository;
    }

    /**
     * @param Moviment $moviment
     * @return Moviment
     * @throws Exception
     */
    public function insert(Moviment $moviment): Moviment
    {
        return $this->movimentRepository->insert($moviment);
    }
}