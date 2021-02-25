<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Dto\Moviment;
use App\Service\MakeMoviment\ValidationDataMoviment;
use App\Util\Response;
use App\Util\Serializer;
use App\Util\Validator;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidationMovimentMiddleware implements MiddlewareInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ValidationDataMoviment
     */
    private $validationDataMoviment;

    /**
     * @var array
     */
    private $typesMovimentConfig;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct(Serializer  $serializer,
                                ValidationDataMoviment $validationDataMoviment,
                                array $typesMovimentConfig)
    {
        $this->serializer = $serializer;
        $this->validationDataMoviment = $validationDataMoviment;
        $this->typesMovimentConfig = $typesMovimentConfig;
        $this->validator = new Validator();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        try {

            $moviment = $this->serializer->deserialize($request->getBody()->getContents(), Moviment::class);
            $validations = $this->validator->validate($moviment, null, ["dep", "sqe"]);

            if ($validations) {
                throw new Exception($validations, 400);
            }

            if ($moviment->getIdTipoMovimento() == $this->typesMovimentConfig['trs']) {
                $validations = $this->validator->validate($moviment, null, ["trs"]);
                if (!$validations) {
                    $validations = $this->validator->validate($moviment->getDestinatario());
                }
                if ($validations) {
                    throw new Exception($validations, 400);
                }
            }

            $this->validationDataMoviment->validation($moviment);

            return $handler->handle($request);
        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode() ?? 500);
        }
    }
}
