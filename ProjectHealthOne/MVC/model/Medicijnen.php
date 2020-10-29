<?php


namespace model;


class Medicijnen
{
    private $id;
    private $naam;
    private $bijwerkingen;
    private  $voordelen;
    private $bedrijfsNaam;

    public function __construct($id, $naam, $bijwerkingen, $voordelen, $bedrijfsNaam)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->bijwerkingen = $bijwerkingen;
        $this->voordelen = $voordelen;
        $this->bedrijfsNaam = $bedrijfsNaam;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNaam()
    {
        return $this->naam;
    }
    public function getBijwerkingen()
    {
        return $this->bijwerkingen;
    }
    public function getVoordelen()
    {
        return $this->voordelen;
    }
    public function getBedrijfsNaam()
    {
        return $this->bedrijfsNaam;
    }
    public function getContent()
    {
        return $this;
    }

}