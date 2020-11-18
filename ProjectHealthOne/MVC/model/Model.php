<?php

namespace model;

include_once ("MVC/model/Medicijnen.php");
include_once ("MVC/model/gebruikers.php");

class model
{
    private $database;

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=drug', "root", "");
    }

   public function insertGebruikers($gebruikersnaam, $wachtwoord)
   {
       $query = $this->database->prepare ("INSERT INTO gebruikers(gebruikersnaam,
wachtwoord) VALUES('ik','".shal('geheim') ."')");
       if ($query->execute()) {
           echo "de niewe gegevens zijn toegevoegd";
       } else {
           echo "er is een fout opgetreden";
       }
       }


   public function getGebruikers($gebruikersnaam, $wachtwoord) {
        if (isset($_POST['gebruikersnaam'])) {
            $gebruikersnaam = $_POST('gebruikersnaam');
            $wachtwoord = shal($_POST['wachtwoord']);
            $query = $this->database->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam =:user AND wachtwoord = :pass ");
            $query->bindParam("user", $gebruikersnaam);
            $query->bindParam("pass", $wachtwoord);
            $query->execute();
            if ($query->rowcount() == 1){
                echo "juiste gegevens!";
            } else {
                echo "onjuiste gegevns!";
            }
            echo "<br>";
        }
   }

    public function insertMedicijnen($naam,$merk,$bijwerkingen,$voordelen){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `Medicijnen` (`id`, `naam`, `merk`, `bijwerkingen`, `voordelen`) 
                VALUES (NULL, :naam, :merk, :bijwerkingen, :voordelen)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":merk", $merk);
            $query->bindParam(":bijwerkingen",$bijwerkingen);
            $query->bindParam(":voordelen", $voordelen);
            $result = $query->execute();
            return $result;
        }
        return -1;



    }
    public function updateMedicijnen($id,$naam,$merk,$bijwerkingen,$voordelen){
        $this->makeConnection();


        $query = $this->database->prepare (
            "UPDATE `Medicijnen` SET `naam` = :naam, `merk`=:merk, `bijwerkingen` = :bijwerkingen,
            `voordelen`=:voordelen
            WHERE `Medicijnen`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":merk", $merk);
        $query->bindParam(":bijwerkingen",$bijwerkingen);
        $query->bindParam(":voordelen", $voordelen);
        $result = $query->execute();
        return $result;
    }


    public function getMedicijnen(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `Medicijnen`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS, Medicijnen::class);
            return $result;
        }
        return null;
    }
    public function selectMedicijnen($id){

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `Medicijnen` 
            WHERE `Medicijnen`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, Medicijnen::class);
            $Medicijnen = $selection->fetch();
            return $Medicijnen;
        }
        return null;
    }
    public function deleteMedicijnen($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `Medicijnen` 
            WHERE `Medicijnen`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }


}