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
                        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: repeat(8, 1fr);
    height: 969px;
}
header {
    grid-area: 1 / 1 / 2 / 7;
    background-color: white;
    height: 75px;
}
nav {
    grid-area: 2 / 1 / 3 / 7;
    background-color: dodgerblue;
    height: 75px;
}
#maintekst {
    grid-area: 3 / 1 / 8 / 7;
    background-color: white;
    height: 800px;
}
footer {
    grid-area: 8 / 1 / 9 / 7;
    background-color: dodgerblue;
    height: 75px;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: dodgerblue;
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: cornflowerblue;
}
li a:active {
    background-color: blue;
    color: white;
}
li a, .dropbtn {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
    background-color: cornflowerblue;
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
    display: block;
}

.topnav input[type=text] {
    float: right;
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
}

.topnav2 input[type=text] {
    padding: 6px;
    border: none;
    margin-top: 8px;
    margin-right: 16px;
    font-size: 17px;
}
                        
                    </style>
                </head>
                <nav>
    <ul>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Menu</a>
            <div class="dropdown-content">
                <a href="MainPage.php">main</a>
                <a href="ContactPage.php">contact</a>

                <a href="#">login</a>
    </div>
        </li>
        <li><a href="MainPage.php">main</a></li>
        <li><a href="ContactPage.php">Contact</a></li>
        <li style="float:right"><a href="#">login</a></li>
        <div class=""topnav> <input type="text" placeholder="Search.."></div>
    </ul>
</nav>
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
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= '" . $Medicijn->bijwerkingen . "'/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= '" . $Medicijn->voordelen . "'/></td></tr>
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
