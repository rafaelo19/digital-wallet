<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\Moviment;
use App\Service\MakeMoviment\MovimentService;
use App\Util\Response;
use Exception;
use App\Util\Serializer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MovimentAccountHandler implements RequestHandlerInterface
{
    /**
     * @var Serializer
     */
    private $serializerUtil;

    /**
     * @var MovimentService
     */
    private $movimentService;

    public function __construct(Serializer $serializerUtil,
                                MovimentService $movimentService)
    {
        $this->serializerUtil = $serializerUtil;
        $this->movimentService = $movimentService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $movimentDto = $this->serializerUtil->deserialize($request->getBody()->getContents(), Moviment::class);
            $this->movimentService->makeMoviment($movimentDto);
            return new Response(["message" => "Movimentação feita com sucesso!"], 201);
        } catch (Exception $e) {
            return new Response(["erro" => $e->getMessage()]);
        }
    }
}
