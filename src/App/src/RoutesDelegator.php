<?php

declare(strict_types=1);

namespace App;

use App\Handler\AccountHandler;
use App\Handler\MovimentAccountHandler;
use App\Middleware\ValidationAccountMiddleware;
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

        $app->post("/contas", [ValidationAccountMiddleware::class, AccountHandler::class], "post.accounts");
        $app->post("/movimentacoes", [ValidationMovimentMiddleware::class, MovimentAccountHandler::class], "post.moviments");

        return $app;
    }
}
