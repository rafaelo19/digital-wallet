<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class HomePageHandlerFactoryTest extends TestCase
{
    public function testFactoryReturnsHandler(): void
    {
        $factory = new HomePageHandlerFactory();
        $container = $this->createMock(ContainerInterface::class);

        $handler = $factory($container);

        $this->assertInstanceOf(HomePageHandler::class, $handler);
    }
}
