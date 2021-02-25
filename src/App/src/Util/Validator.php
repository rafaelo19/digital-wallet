<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct()
    {
        $this->setValidator();
    }

    private function setValidator()
    {
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    public function validate($object, $message = null, $groups = null): string
    {
        $constraints = $this->validator->validate($object, null, $groups);
        $violations = $message ? $message : "";
        foreach ($constraints as $value) {
            if (!empty($value)) {
                $violations .= $violations == "" ? $value->getMessage() : ", ". $value->getMessage();
            }
        }
        return $violations;
    }
}
