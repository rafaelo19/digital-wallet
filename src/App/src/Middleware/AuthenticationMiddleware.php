<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\Auth\JwtService;
use App\Service\Auth\ValidateUserService;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class AuthenticationMiddleware implements MiddlewareInterface
{
    /**
     * @var JwtService
     */
    private $jwtService;

    /**
     * @var ValidateUserService
     */
    private $validateUserService;

    public function __construct(JwtService $jwtService,
                                ValidateUserService $validateUserService)
    {
        $this->jwtService = $jwtService;
        $this->validateUserService = $validateUserService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $authorization = trim($request->getHeaderLine('Authorization'));

            if ($authorization === '') {
                throw new Exception('Acesso nao autorizado!', 401);
            }

            if (!preg_match('/^Bearer\s+(.+)$/i', $authorization, $matches)) {
                throw new Exception('Acesso nao autorizado!', 401);
            }

            $payload = $this->jwtService->validateToken(trim($matches[1]));
            $idUser = (int) ($payload['sub'] ?? 0);
            $authenticatedUser = $this->validateUserService->getActiveUser($idUser);

            return $handler->handle($request
                ->withAttribute('tokenPayload', $payload)
                ->withAttribute('authenticatedUser', $authenticatedUser));
        } catch (Throwable $e) {
            $status = $e->getCode();
            if (!is_int($status) || $status < 400 || $status >= 600) {
                $status = 401;
            }

            return new JsonResponse(['erro' => $e->getMessage()], $status);
        }
    }
}
