<?php

declare(strict_types=1);

namespace App;

use App\Factory\EntityManagerFactory;
use App\Handler\AccountHandler;
use App\Handler\AccountHandlerFactory;
use App\Handler\GetMovimentAccountHandler;
use App\Handler\GetMovimentAccountHandlerFactory;
use App\Handler\LoginHandler;
use App\Handler\LoginHandlerFactory;
use App\Handler\MovimentAccountHandler;
use App\Handler\MovimentAccountHandlerFactory;
use App\Middleware\AuthenticationMiddleware;
use App\Middleware\AuthenticationMiddlewareFactory;
use App\Middleware\ValidationAccountMiddleware;
use App\Middleware\ValidationAccountMiddlewareFactory;
use App\Middleware\ValidationLoginMiddleware;
use App\Middleware\ValidationLoginMiddlewareFactory;
use App\Middleware\ValidationMovimentMiddleware;
use App\Middleware\ValidationMovimentMiddlewareFactory;
use App\Service\Account\AccountAuthorizationService;
use App\Service\Account\AccountAuthorizationServiceFactory;
use App\Service\Account\GetAccountService;
use App\Service\Account\GetAccountServiceFactory;
use App\Service\Account\InsertUpdateAccountService;
use App\Service\Account\InsertUpdateAccountServiceFactory;
use App\Service\Auth\JwtService;
use App\Service\Auth\JwtServiceFactory;
use App\Service\Auth\LoginService;
use App\Service\Auth\LoginServiceFactory;
use App\Service\Auth\ValidateUserService;
use App\Service\Auth\ValidateUserServiceFactory;
use App\Service\MakeMoviment\MovimentService;
use App\Service\MakeMoviment\MovimentServiceFactory;
use App\Service\MakeMoviment\ValidationDataMoviment;
use App\Service\MakeMoviment\ValidationDataMovimentFactory;
use App\Service\Moviment\GetMovimentService;
use App\Service\Moviment\GetMovimentServiceFactory;
use App\Service\Moviment\InsertMovimentService;
use App\Service\Moviment\InsertMovimentServiceFactory;
use App\Service\TypeMoviment\GetTypeMovimentService;
use App\Service\TypeMoviment\GetTypeMovimentServiceFactory;
use App\Util\Serializer;
use App\Util\SerializerFactory;
use Doctrine\ORM\EntityManager;
use Mezzio\Application;

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
            'invokables' => [],
            'factories'  => [
                #Db
                EntityManager::class => EntityManagerFactory::class,

                #Middleware
                AuthenticationMiddleware::class => AuthenticationMiddlewareFactory::class,
                ValidationAccountMiddleware::class => ValidationAccountMiddlewareFactory::class,
                ValidationLoginMiddleware::class => ValidationLoginMiddlewareFactory::class,
                ValidationMovimentMiddleware::class => ValidationMovimentMiddlewareFactory::class,

                #Handler
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                AccountHandler::class => AccountHandlerFactory::class,
                LoginHandler::class => LoginHandlerFactory::class,
                MovimentAccountHandler::class => MovimentAccountHandlerFactory::class,
                GetMovimentAccountHandler::class => GetMovimentAccountHandlerFactory::class,

                #Service
                JwtService::class => JwtServiceFactory::class,
                LoginService::class => LoginServiceFactory::class,
                ValidateUserService::class => ValidateUserServiceFactory::class,
                AccountAuthorizationService::class => AccountAuthorizationServiceFactory::class,
                GetTypeMovimentService::class => GetTypeMovimentServiceFactory::class,
                GetAccountService::class => GetAccountServiceFactory::class,
                InsertUpdateAccountService::class => InsertUpdateAccountServiceFactory::class,
                InsertMovimentService::class => InsertMovimentServiceFactory::class,
                MovimentService::class => MovimentServiceFactory::class,
                GetMovimentService::class => GetMovimentServiceFactory::class,
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
