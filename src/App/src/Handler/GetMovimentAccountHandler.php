<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use App\Service\Account\AccountAuthorizationService;
use App\Service\Moviment\GetMovimentService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class GetMovimentAccountHandler implements RequestHandlerInterface
{
    /**
     * @var GetMovimentService
     */
    private $getMovimentService;

    /**
     * @var AccountAuthorizationService
     */
    private $accountAuthorizationService;

    public function __construct(GetMovimentService $getMovimentService,
                                AccountAuthorizationService $accountAuthorizationService)
    {
        $this->getMovimentService = $getMovimentService;
        $this->accountAuthorizationService = $accountAuthorizationService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $idAccount = intval($request->getAttribute("idconta"));
            $authenticatedUser = $request->getAttribute('authenticatedUser');
            if (!$authenticatedUser) {
                throw new Exception('Acesso nao autorizado!', 401);
            }

            $idUser = $authenticatedUser->getId();
            $this->accountAuthorizationService->ensureOwnership($idAccount, $idUser);
            return new JsonResponse(['data' => $this->getMovimentService->getMoviments($idAccount)], 200);
        } catch (Throwable $e) {
            $status = $e->getCode();
            if (!is_int($status) || $status < 400 || $status >= 600) {
                $status = 500;
            }

            return new JsonResponse(['erro' => $e->getMessage()], $status);
        }
    }
}
