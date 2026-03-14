<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Util\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class HomePageHandlerTest extends TestCase
{
    public function testReturnsApiResponse(): void
    {
        $handler = new HomePageHandler();
        $request = $this->createMock(ServerRequestInterface::class);

        $response = $handler->handle($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('Api-Digital-Wallet', (string) $response->getBody());
    }
}
