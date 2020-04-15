<?php

namespace App\Other;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class Errorer
{
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