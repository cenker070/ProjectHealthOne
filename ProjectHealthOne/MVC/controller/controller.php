<?php


namespace Controller;

use View\view;
use Model\model;
use Model\Medicijnen;


class controller
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }
    public function updateModel(string $newContent)
    {
        $this->model->content = $newContent;
    }
    public function updateView()
    {
        $this->view->viewContent();
    }

}