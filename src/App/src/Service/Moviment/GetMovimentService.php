<?php

declare(strict_types=1);

namespace App\Service\Moviment;

use Exception;
use App\Repository\MovimentRepository;

class GetMovimentService
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
     * @param int $idAccount
     * @return array
     * @throws Exception
     */
    public function getMoviments(int $idAccount): array
    {
        return $this->movimentRepository->getMoviments($idAccount);
    }
}
