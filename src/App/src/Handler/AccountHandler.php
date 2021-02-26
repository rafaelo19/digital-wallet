<?php

declare(strict_types=1);

namespace App\Handler;

use App\Dto\Response as ResponseDto;
use App\Service\Account\InsertUpdateAccountService;
use App\Util\Response;
use App\Util\Serializer;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AccountHandler implements RequestHandlerInterface
{
    /**
     * @var Serializer
     */
    private $serializerUtil;

    /**
     * @var InsertUpdateAccountService
     */
    private $insertUpdateAccountService;

    public function __construct(Serializer $serializerUtil,
                                InsertUpdateAccountService $insertUpdateAccountService)
    {
        $this->serializerUtil = $serializerUtil;
        $this->insertUpdateAccountService = $insertUpdateAccountService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $this->insertUpdateAccountService->insertAccount($request->getAttribute('accountDto'));
            $res = new ResponseDto();
            $res->setData("Conta criado com sucesso!");
            return new Response($res, 201);
        } catch (Exception $e) {
            return new Response(["erro" => $e->getMessage()]);
        }
    }
}
