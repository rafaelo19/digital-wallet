<?php

declare(strict_types=1);

namespace App;

use App\Handler\AccountHandler;
use App\Handler\GetMovimentAccountHandler;
use App\Handler\LoginHandler;
use App\Handler\MovimentAccountHandler;
use App\Middleware\AuthenticationMiddleware;
use App\Middleware\ValidationAccountMiddleware;
use App\Middleware\ValidationLoginMiddleware;
use App\Middleware\ValidationMovimentMiddleware;
use Mezzio\Application;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        /**
         * @var Application $app
         */
        $app = $callback();

        $app->post("/login", [ValidationLoginMiddleware::class, LoginHandler::class], "post.login");
        $app->post("/contas", [AuthenticationMiddleware::class, ValidationAccountMiddleware::class, AccountHandler::class], "post.accounts");
        $app->post("/movimentacoes", [AuthenticationMiddleware::class, ValidationMovimentMiddleware::class, MovimentAccountHandler::class], "post.moviments");
        $app->get("/contas/{idconta:\d+}/movimentacoes", [AuthenticationMiddleware::class, GetMovimentAccountHandler::class], "get.moviments");

        return $app;
    }
}
