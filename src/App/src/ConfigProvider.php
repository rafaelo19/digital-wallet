<?php

declare(strict_types=1);

namespace App;

use App\Handler\AccountHandler;
use App\Handler\AccountHandlerFactory;
use App\Service\InsertAccountService;
use App\Service\InsertAccountServiceFactory;
use App\Util\SerializerUtil;
use App\Util\SerializerUtilFactory;
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

                #Handler
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                AccountHandler::class => AccountHandlerFactory::class,

                #Service
                InsertAccountService::class => InsertAccountServiceFactory::class,

                #Util
                SerializerUtil::class => SerializerUtilFactory::class,
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
