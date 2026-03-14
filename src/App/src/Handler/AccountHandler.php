<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Account\InsertUpdateAccountService;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class AccountHandler implements RequestHandlerInterface
{
    /**
     * @var InsertUpdateAccountService
     */
    private $insertUpdateAccountService;

    public function __construct(InsertUpdateAccountService $insertUpdateAccountService)
    {
        $this->insertUpdateAccountService = $insertUpdateAccountService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $authenticatedUser = $request->getAttribute('authenticatedUser');
            if (!$authenticatedUser) {
                throw new Exception('Acesso nao autorizado!', 401);
            }

            $idUser = $authenticatedUser->getId();
            $this->insertUpdateAccountService->insertAccount($request->getAttribute('accountDto'), $idUser);
            return new JsonResponse(['data' => 'Conta criado com sucesso!'], 201);
        } catch (Throwable $e) {
            $status = $e->getCode();
            if (!is_int($status) || $status < 400 || $status >= 600) {
                $status = 500;
            }

            return new JsonResponse(['erro' => $e->getMessage()], $status);
        }
    }
}
