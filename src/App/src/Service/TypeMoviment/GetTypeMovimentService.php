<?php

declare(strict_types=1);

namespace App\Service\TypeMoviment;

use App\Entity\TypeMoviment;
use App\Repository\TypeMovimentRepository;
use Exception;

class GetTypeMovimentService
{
    /**
     * @var TypeMovimentRepository
     */
    private $typeMovimentRepository;

    public function __construct(TypeMovimentRepository $typeMovimentRepository)
    {
        $this->typeMovimentRepository = $typeMovimentRepository;
    }

    /**
     * @param int $id
     * @return TypeMoviment|null
     * @throws Exception
     */
    public function get(int $id): ?TypeMoviment
    {
        return $this->typeMovimentRepository->get($id);
    }
}
