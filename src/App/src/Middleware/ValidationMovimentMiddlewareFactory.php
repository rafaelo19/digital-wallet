<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\MakeMoviment\ValidationDataMoviment;
use App\Util\Serializer;
use Psr\Container\ContainerInterface;

class ValidationMovimentMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ValidationMovimentMiddleware
    {
        $serializer = $container->get(Serializer::class);
        $validationDataMoviment = $container->get(ValidationDataMoviment::class);
        $typesMovimentConfig = $container->get('config')['types-moviment'];
        return new ValidationMovimentMiddleware($serializer,
            $validationDataMoviment,
            $typesMovimentConfig);
    }
}
