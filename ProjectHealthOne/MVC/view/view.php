<?php
namespace view;


include_once ("MVC/model/Model.php");

include_once ("MVC/model/Medicijnen.php");

class View
{

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function showGebruikers($result = null)
    {
        if ($result == 1) {
            echo "actie geslaagd";
        }
        $gebruikers = $this->model->getgebruikers();
    }


    public
    function showMedicijnen($result = null)
    {

        if ($result == 1) {
            echo "<h4>Actie geslaagd</h4>";
        }
        $Medicijnen = $this->model->getMedicijnen();


        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>medicijnen</title>
                    <style>
                        #Medicijnen{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .Medicijn{
                            width:80%;
                            background-color:#ccccff;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";
        echo "<h2>Medicijnen</h2> <form action='index.php' method='post'>
                               <input type='hidden' name='showForm' value='0'>
                               <input type='submit' value='toevoegen'/>
                               </form></div></body></html>";
        if ($Medicijnen !== null) {
            echo "
                        <div id=\"Medicijnen\">";
            foreach ($Medicijnen as $Medicijn) {
                echo "<div class=\"Medicijn\">
                                       
                                      $Medicijn->naam<br />
                                      $Medicijn->merk<br />
                                      $Medicijn->bijwerkingen<br />
                                      $Medicijn->voordelen<br />
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showForm' value='$Medicijn->id'><input type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='delete' value='$Medicijn->id'><input type='submit' value='verwijderen'/></form>
                                    </div>";
            }
        } else {
            echo "Geen medicijnen gevonden";
        }

    }

    public
    function showFormMedicijnen($id = null)
    {
        if ($id != null && $id != 0) {
            $Medicijn = $this->model->selectMedicijn($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer Medicijnengegevens</title>
        </head><body>
        <h2>Formulier Medicijnengegevens</h2>";
        if (isset($Medicijn)) {
            echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '" . $Medicijn->naam . "'/></td></tr>
            <tr><td>
                <label for=\"merk\">merk</label></td><td>
                <input type=\"text\" name=\"merk\" value = '" . $Medicijn->merk . "'/></td></tr>
            <tr><td>
                <label for=\"bijwerkingen\">bijwerkingen</label></td><td>
                <input type=\"text\" name=\"bijwerkingen\" value= '" . $Medicijn->bijwerkingen . "'/></td></tr>
            <tr><td>
                <label for=\"voordelen\">voordelen</label></td><td>
                <input type=\"text\" name=\"voordelen\" value= '" . $Medicijn->voordelen . "'/></td></tr>
            <tr><td>
            <tr><td>
                <input type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        } else {
            /*de html template */
            echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= ''/></td></tr>
            <tr><td>
                <label for=\"merk\">merk</label></td><td>
                <input type=\"text\" name=\"merk\" value = ''/></td></tr>
            <tr><td>
                <label for=\"bijwerkingen\">bijwerkingen</label></td><td>
                <input type=\"text\" name=\"bijwerkingen\" value= ''/></td></tr>
            <tr><td>
                <label for=\"voordelen\">voordelen</label></td><td>
                <input type=\"text\" name=\"voordelen\" value= ''/></td></tr>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }
}
