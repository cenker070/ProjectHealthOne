<?php


namespace Model;


class model
{
    public $content;
    private $Medicijnen;

    public function __construct()
    {
        $this->Medicijnen = new Medicijnen("", "", "", "", "",);
    }
    public function getContent()
    {
        return $this->Medicijnen->getContent();
    }
    public function getMedicijnen()
    {
        return $this->Medicijnen->getMedicijnen();
    }

}