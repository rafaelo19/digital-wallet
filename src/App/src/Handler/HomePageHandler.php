<?php

declare(strict_types=1);

namespace App\Handler;

use App\Util\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(["data" => "Api-Digital-Wallet"], 200);
    }
}
