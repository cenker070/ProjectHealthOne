<?php

namespace model;
use model\model;
include_once ("MVC/model/Model.php");


class gebruikers
{
    private $id;
    private $gebruikersnaam;
    private $wachtwoord;

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}

