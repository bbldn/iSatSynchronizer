<?php

namespace App\Entity;

class BaseEntity
{
    public function setField(string $key, $value)
    {
        if (false === property_exists($this, $key)) {
            //@TODO
            return;
        }

        $this->$key = $value;
    }
}