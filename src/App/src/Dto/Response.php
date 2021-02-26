<?php

declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation\Type;

class Response
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

}