<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Dto\Account;
use App\Util\Response;
use App\Util\Serializer;
use App\Util\Validator;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidationAccountMiddleware implements MiddlewareInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct(Serializer  $serializer)
    {
        $this->serializer = $serializer;
        $this->validator = new Validator();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        try {
            $accountDto = $this->serializer->deserialize($request->getBody()->getContents(), Account::class);
            $validations = $this->validator->validate($accountDto);
            if ($validations) {
                throw new Exception($validations, 400);
            }
            return $handler->handle($request->withAttribute('accountDto', $accountDto));
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode() ?? 500);
        }
    }
}
