<?php

declare(strict_types=1);

namespace App;

use App\Handler\AccountHandler;
use App\Handler\AccountHandlerFactory;
use App\Handler\MovimentAccountHandler;
use App\Handler\MovimentAccountHandlerFactory;
use App\Middleware\ValidationAccountMiddleware;
use App\Middleware\ValidationAccountMiddlewareFactory;
use App\Middleware\ValidationMovimentMiddleware;
use App\Middleware\ValidationMovimentMiddlewareFactory;
use App\Service\Account\GetAccountService;
use App\Service\Account\GetAccountServiceFactory;
use App\Service\Account\InsertUpdateAccountService;
use App\Service\Account\InsertUpdateAccountServiceFactory;
use App\Service\MakeMoviment\MovimentService;
use App\Service\MakeMoviment\MovimentServiceFactory;
use App\Service\MakeMoviment\ValidationDataMoviment;
use App\Service\MakeMoviment\ValidationDataMovimentFactory;
use App\Service\Moviment\InsertMovimentService;
use App\Service\Moviment\InsertMovimentServiceFactory;
use App\Service\TypeMoviment\GetTypeMovimentService;
use App\Service\TypeMoviment\GetTypeMovimentServiceFactory;
use App\Util\Serializer;
use App\Util\SerializerFactory;
use Doctrine\ORM\EntityManager;
use Mezzio\Application;
use Roave\PsrContainerDoctrine\EntityManagerFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'delegators' => [
                Application::class => [RoutesDelegator::class]
            ],
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                #Db
                EntityManager::class => EntityManagerFactory::class,

                #Middleware
                ValidationAccountMiddleware::class => ValidationAccountMiddlewareFactory::class,
                ValidationMovimentMiddleware::class => ValidationMovimentMiddlewareFactory::class,

                #Handler
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                AccountHandler::class => AccountHandlerFactory::class,
                MovimentAccountHandler::class => MovimentAccountHandlerFactory::class,

                #Service
                GetTypeMovimentService::class => GetTypeMovimentServiceFactory::class,
                GetAccountService::class => GetAccountServiceFactory::class,
                InsertUpdateAccountService::class => InsertUpdateAccountServiceFactory::class,
                InsertMovimentService::class => InsertMovimentServiceFactory::class,
                MovimentService::class => MovimentServiceFactory::class,
                ValidationDataMoviment::class => ValidationDataMovimentFactory::class,

                #Util
                Serializer::class => SerializerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
