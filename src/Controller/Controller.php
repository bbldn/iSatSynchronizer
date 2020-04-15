<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Collection;

class Controller extends AbstractController
{
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    protected function getValidationCollection(array $fields): Collection
    {
        return new Collection([
            'fields' => $fields,
            'missingFieldsMessage' => 'Field {{ field }} not found',
            'extraFieldsMessage' => 'Field {{ field }} was not expected',
        ]);
    }
}