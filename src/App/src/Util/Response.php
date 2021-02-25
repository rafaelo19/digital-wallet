<?php

declare (strict_types=1);

namespace App\Util;

use Psr\Container\ContainerInterface;
use Laminas\Diactoros\Response as ResponseLaminas;
use Laminas\Diactoros\Response\InjectContentTypeTrait;
use Laminas\Diactoros\Stream;

class Response extends ResponseLaminas
{
    use InjectContentTypeTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var int
     */
    private $typeResponse;

    public function __construct($data, ?int $status = 200)
    {
        if (!$status) {
            $status = 500;
        }

        if ($status < 200 || $status >= 400) {
            $data = ['erro' => $data];
        }

        $this->container = require 'config/container.php';

        $this->serializer = $this->container->get(Serializer::class);

        $body = $this->createBodyFromJson($this->serializer->serialize($data));
        $headers = $this->injectContentType('application/json', []);
        parent::__construct($body, $status, $headers);
    }

    /**
     * @param string $json
     * @return Stream
     */
    private function createBodyFromJson(string $json): Stream
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write($json);
        $body->rewind();
        return $body;
    }
}
