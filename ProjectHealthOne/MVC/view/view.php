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
                        }body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: dodgerblue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }


        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }
                        
                    </style>
                </head>
                <body>
<h2>Inloggen</h2>

<form action=\"index.php\" method=\"post\">
    <div class=\"imgcontainer\">
        <img src=\"templates/images/loginAvatar.png\" alt=\"Avatar\" class=\"avatar\">
    </div>

    <div class=\"container\">
        <label for=\"uname\"><b>Gebruikersnaam</b></label>
        <input type=\"text\" placeholder=\"Enter Username\" name=\"uname\" required>

        <label for=\"psw\"><b>Wachtwoord</b></label>
        <input type=\"password\" placeholder=\"Enter Password\" name=\"psw\" required>

        <button type=\"submit\" name='inloggen'>Login</button>
        <label>
            <input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me
    </label>
    </div>

    <div class=\"container\" style=\"background-color:#f1f1f1\">
        <span class=\"psw\">Forgot <a href=\"#\">password?</a></span>
    </div>
</form>

</body>
</html>";
         if(isset($_SESSION['username'])) {echo $_SESSION['username'];}

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
                                      $prijs->prijs<br />
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
            echo "<form method='post'>
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
                <label for=\"prijs\">prijs</label></td><td>
                <input type=\"text\" name=\"prijs\" value= '" . $prijs->prijs . "'/></td></tr>
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
                <tr><td>
                <label for=\"prijs\">prijs</label></td><td>
                <input type=\"text\" name=\"prijs\" value= ''/></td></tr>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }
}
