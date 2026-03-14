<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\Auth\LoginService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class LoginHandler implements RequestHandlerInterface
{
    /**
     * @var LoginService
     */
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $result = $this->loginService->login($request->getAttribute('loginDto'));
            return new JsonResponse(['data' => $result], 200);
        } catch (Throwable $e) {
            $status = $e->getCode();
            if (!is_int($status) || $status < 400 || $status >= 600) {
                $status = 500;
            }

            return new JsonResponse(['erro' => $e->getMessage()], $status);
        }
    }
}
