<?php

namespace model;
use model\model;
include_once("MVC/model/Model.php");

class medicijnen
{
    private $id;
    private $naam;
    private $merk;
    private $bijwerkingen;
    private $voordelen;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

}