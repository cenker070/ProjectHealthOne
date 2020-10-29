<?php


namespace View;


use Model\model;

class view
{
    private $model;

    public function __construct(model $model)
    {
        $this->model = $model;
    }
    public function viewContent()
    {
        $Medicijnen = $this->model->getContent();
        echo "<h2> medicijnen lijst ";
        echo "id : ". $Medicijnen->getId();
        echo "naam : ". $Medicijnen->getNaam();
        echo "bijwerkingen". $Medicijnen->getBijwerkingen();
        echo  "voordelen : ". $Medicijnen->getVoordelen();
        echo ""

    }

}