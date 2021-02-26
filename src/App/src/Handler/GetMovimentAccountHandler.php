<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Moviment\GetMovimentService;
use App\Util\Response;
use App\Dto\Response as ResponseDto;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetMovimentAccountHandler implements RequestHandlerInterface
{
    /**
     * @var GetMovimentService
     */
    private $getMovimentService;

    public function __construct(GetMovimentService $getMovimentService)
    {
        $this->getMovimentService = $getMovimentService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $idAccount = intval($request->getAttribute("idconta"));
            $res = new ResponseDto();
            $res->setData($this->getMovimentService->getMoviments($idAccount));
            return new Response($res, 201);
        } catch (Exception $e) {
            return new Response(["erro" => $e->getMessage()]);
        }
    }
}
