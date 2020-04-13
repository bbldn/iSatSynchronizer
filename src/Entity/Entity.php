<?php

namespace App\Entity;

class Entity
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