<?php

namespace App\Helper;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class Errorer
{
    /**
     * @param ConstraintViolationListInterface $constraintViolationList
     * @return array
     */
    public static function convertConstraintViolationListToArray(
        ConstraintViolationListInterface $constraintViolationList
    ): array
    {
        $errorsResult = [];

        foreach ($constraintViolationList as $error) {
            $errorsResult[] = $error->getMessage();
        }

        return $errorsResult;
    }
}