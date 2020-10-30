<?php


namespace model;

use model\Medicijnen;
include_once ("model/Medicijnen");

class model
{
    public $content;
    private $Medicijnen;

    public function __construct()
    {
        $this->Medicijnen = new Medicijnen("10498543284", "ibrupofen", "misselijkheid", "stilt pijn", "kela");
    }
    public function getContent()
    {
        return $this->Medicijnen->getContent();
    }
    public function getMedicijnen()
    {
        return $this->Medicijnen;
    }

}