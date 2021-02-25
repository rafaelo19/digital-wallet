<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Account;
use App\Service\InsertAccountService;
use App\Util\Response;
use Exception;
use App\Util\Serializer;
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
     * @var InsertAccountService
     */
    private $insertAccountService;

    public function __construct(Serializer $serializerUtil,
                                InsertAccountService $insertAccountService)
    {
        $this->serializerUtil = $serializerUtil;
        $this->insertAccountService = $insertAccountService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $entity = $this->serializerUtil->deserialize($request->getBody()->getContents(), Account::class);
            $entity = $this->insertAccountService->insert($entity);
            return new Response($entity, 201);
        } catch (Exception $e) {
            return new Response(["erro" => $e->getMessage()]);
        }
    }
}
