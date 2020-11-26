<?php
namespace controller;
use View\View;
include_once ("MVC/view/view.php");
use Model\Model;
include_once ("MVC/model/Model.php");

class controller
{
    private $view;
    private $model;
    public function __construct(){
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function readMedicijnAction(){
        $this->view->showMedicijnen();
    }

    public function showFormMedicijnAction($id=null){
        $this->view->showFormMedicijnen($id);
    }
    public function createMedicijnAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $merk = filter_input(INPUT_POST,'merk');
        $voordelen = filter_input(INPUT_POST,'voordelen');
        $bijwerkingen = filter_input(INPUT_POST,'bijwerkingen');
        $prijs = filter_input(INPUT_POST,'prijs');
        $result = $this->model->insertMedicijnen($naam,$merk,$voordelen,$bijwerkingen, $prijs);
        $this->view->showMedicijnen($result);
    }
    public function updateMedicijnAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $merk = filter_input(INPUT_POST,'merk');
        $voordelen = filter_input(INPUT_POST,'voordelen');
        $bijwerkingen = filter_input(INPUT_POST,'bijwerkingen');
        $prijs = filter_input(INPUT_POST,'prijs');
        $result=$this->model->updateMedicijnen($id,$naam,$merk,$voordelen,$bijwerkingen, $prijs);
        $this->view->showMedicijnen($result);
    }
    public function deleteMedicijnAction($id){
        $result = $this->model->deleteMedicijnen($id);
        $this->view->showMedicijnen($result);
    }
    public function inloggenAction(){
        $gebruikersnaam = filter_input(INPUT_POST, "uname");
        $wachtwoord = filter_input(INPUT_POST, "psw");
        $this->model->inloggen($gebruikersnaam, $wachtwoord);
        $this->readMedicijnAction();

    }
}