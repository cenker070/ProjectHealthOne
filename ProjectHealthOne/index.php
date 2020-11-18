<?php

use controller\controller;
include_once("MVC/controller/controller.php");
use model\Model;
include_once("MVC/model/Model.php");
use view\View;
include_once("MVC/view/view.php");
$Model = new Model();
$View = new View($Model);
$controller = new Controller();


if(isset($_POST['showForm']))
{
    $controller->showFormMedicijnAction( $_POST['showForm']);
}

else if(isset($_POST['update']))
{
    $controller->updateMedicijnAction();
}

else if(isset($_POST['create']))
{
    $controller->createMedicijnAction();
}

else if(isset($_POST['delete']))
{
    $controller->deleteMedicijnAction($_POST['delete']);
}

else
{
    $controller->readMedicijnAction();
}

