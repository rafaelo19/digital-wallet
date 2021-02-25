<?php

declare(strict_types=1);

namespace App\Util;

use Exception;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer as JmsSerializer;

class Serializer
{
    /**
     * @var JmsSerializer
     */
    private $serializer;

    private const TYPE_FORMAT = "json";

    public function __construct()
    {
        $this->configSerializer();
    }

    private function configSerializer(): void
    {
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }

    /**
     * @param $data
     * @return string
     * @throws Exception
     */
    public function serialize($data)
    {
        try {
            return $this->serializer->serialize($data, self::TYPE_FORMAT);
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar serializar dados!", 400);
        }
    }

    /**
     * @param $data
     * @param $object
     * @return mixed
     * @throws Exception
     */
    public function deserialize($data, $object)
    {
        try {
            return $this->serializer->deserialize($data, $object, self::TYPE_FORMAT);
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
            throw new Exception("Erro ao tentar deserializar dados!", 400);
        }
    }

}
