<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Account;
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
            $entity = $this->serializerUtil->deserialize($request->getBody()->getContents(), Account::class);
            $entity = $this->insertUpdateAccountService->insertUpdate($entity);
            return new Response($entity, 201);
        } catch (Exception $e) {
            return new Response(["erro" => $e->getMessage()]);
        }
    }
}
