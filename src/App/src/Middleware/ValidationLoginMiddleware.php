<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Dto\Login;
use App\Util\Serializer;
use App\Util\Validator;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;

class ValidationLoginMiddleware implements MiddlewareInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
        $this->validator = new Validator();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $loginDto = $this->serializer->deserialize($request->getBody()->getContents(), Login::class);
            $validations = $this->validator->validate($loginDto);

            if ($validations) {
                throw new Exception($validations, 400);
            }

            return $handler->handle($request->withAttribute('loginDto', $loginDto));
        } catch (Throwable $e) {
            $status = $e->getCode();
            if (!is_int($status) || $status < 400 || $status >= 600) {
                $status = 500;
            }

            return new JsonResponse(['erro' => $e->getMessage()], $status);
        }
    }
}
