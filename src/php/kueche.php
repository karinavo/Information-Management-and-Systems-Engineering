<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
   ////////// MONGO DB CONNECTION ///////////
   // connect to mongodb
   $m = new MongoDB\Client("mongodb://localhost:27017");

   echo "Connected to database succesfully";
   // select a database
   $db = $m->imse_mongodb;

   echo "Database imse_mongodb selected";
   ////////// MONGO DB CONNECTION ///////////
?>
<?php /*
$servername = "mariadb";
$username = "root";
$password = "rootpsw";
$dbname = "imse_db";
try {
    $conn = new PDO("mysql:host=$servername;$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
}*/
?>


<html>
<title>Die Kochschule</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--icon-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*text style*/
        h1 {
            font-family:  "TeX Gyre ", serif; /* Гарнитура текста */
            font-size: 65%; /* Размер шрифта в процентах */
        }

    </style>
    <!--Dropdown botton-->
    <style>
        body {
            font-family:  "TeX Gyre ", serif;
        }

        .sidenav{
            height: 100%;
            width:200px;
            position: fixed;
            z-index: 1;
            top:0;
            left: 0;
            background-color:#4d4d4d ;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .dropdown-btn {
            float: left;
            overflow: hidden;
        }
        .dropdown .dropdown-btn {
            padding: 0px 0px 0px 6px;
            text-decoration: none;
            font-size: 20px;
            color: bisque;
            display:block;
            border:  bisque;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            overflow: hidden;
            margin-left: 0px;
            margin-right: 0px;
        }
        /* Style the sidenav links and the dropdown button */
        .sidenav a, .dropdown-btn{
            padding: 6px 8px 6px 16px;
            overflow: hidden;
            text-decoration: none;
            font-size: 20px;
            color: bisque;
            display:block;
            border:  bisque;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            margin: 0;
        }

        .sidenav a:hover,.dropdown-btn:hover{
            color: bisque;
        }
        .main{
            margin-left: 200px; /* Same as the width of the sidenav */
            font-size: 20px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }
        .dropdown-content {
            display: none;
            background-color: #4d4d4d;
            min-width: 200px;
        }

        .dropdown-content a {
            float: none;
            color: bisque;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #4d4d4d;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-container{
            display: none;
            background-color: #4d4d4d;
            padding-left:8px;
        }
        .fa-caret-down{
            display: none;
            float: right;
            padding-right: 8px;
        }

        @media screen and(max-height: 450px){
            .sidenav{padding-top: 15px;}
            .sidenav a {font-size: 18px;}

        }

    </style>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <img src="Culinary.png" alt="Cooking courses logo" style="width:200px;height:200px;" class="center" align="top">
    <style>
        p.oblique {
            font-style:oblique;
        }
        div.a{
            text-align: center;
        }
    </style>
    <div class="a">
        <p class="oblique" > Die Küchen</p>
    </div>


    <!--Search style-->
    <style>
        * {
            box-sizing: border-box;
        }

        form.example input[type=text] {
            padding: 7px;
            font-size: 17px;
            border: 1px solid #bbbbbb;
            float: left;
            width: 75%;
            background: white;
        }

        form.example button {
            float: left;
            width: 10%;
            padding: 7px;
            background:white;
            color:#4d4d4d;
            font-size: 17px;
            border: 1px solid #bbbbbb;
            border-left: none;
            cursor: pointer;
        }

        form.example button:hover {
            background: white;
        }

        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <style>
        /*Table style*/
        table,td,th {
            border: 1px solid #bbbbbb;
            text-align: left;
        }
        table{
            border-collapse: collapse;
            width:75%;
        }
        th,td{
            text-align: left;
            padding: 9px;
        }
        th {
            background-color: whitesmoke;
            color: #4d4d4d;
        }
    </style>
    <style>
        /*Insert  Button*/
        .buttoninsert{
            background-color: #4d4d4d;
            border:2px solid #4d4d4d;
            color: bisque;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor:pointer;
        }
    </style>
    <script>
        function resetForm() {
            document.getElementById("insertform").reset();
        }
    </script>
</head>


<body>
<!--background-->
<div class="sidenav">
    <div class="dropdown">
        <button class="dropdown-btn"> &#9778
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content" style="margin-left: 6%">
            <a href="index.php">Home</a>
            <a href="kueche.php">Küche</a>
            <a href="kochkurse.php">Kochkurse</a>
            <a href="koch.php">Unsere Köche</a>
            <a href="termine.php">Termine</a>
            <a href="fuehrt.php">Fuehrung</a>
            <a href="kursteilnehmer.php">Kursteilnehmer</a>
            <a href="mitarbeiter.php">Mitarbeiter</a>
            <a href="manager.php">Manager</a>
            <a href="bericht.php">Bericht</a>

        </div>
    </div>
</div>

<div class="main">
    <!--Insert Formular-->
    <div>
        <form id='insertform' action='kueche.php' method='get'>
            Neue Küche einfuegen:
            <table>
                <thead>
                <tr>
                    <th>AbteilungsNr</th>
                    <th>Nummer</th>
                    <th>Fassungsvermoegen</th>
                    <th>Ausstattung</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input id='AbteilungsNr' name='AbteilungsNr' type='number' size='10' value='<?php echo $_GET['AbteilungsNr']; ?>' />
                    </td>
                    <td>
                        <input id='Nummer' name='Nummer' type='number' size='10' value='<?php echo $_GET['Nummer']; ?>' />
                    </td>
                    <td>
                        <input id="Fassungsvermoegen" name="Fassungsvermoegen" type="number" size="10" value="<?php   echo $_GET['Fassungsvermoegen'];?>"/>
                    </td>
                    <td>
                        <input id="Ausstattung" name="Ausstattung" type="text" size="10" value="<?php  echo $_GET['Ausstattung'];?>"/>
                    </td>

                </tr>
                </tbody>
            </table>
            <input class="buttoninsert" id='submit1' type='submit' value='Insert'  />
            <input class="buttoninsert" type="button" onclick="resetForm()" value="Clear fields">

        </form>
    </div>
    <!--In SQL for Insert-->
    <?php
    //HANDLE insert
    if(isset($_GET['Nummer'])) {
        //Prepare insert statementd
        //$sql="INSERT INTO imse_db.Kueche(AbteilungsNr,Nummer,Fassungsvermoegen,Ausstattung) VALUES(" . $_GET['AbteilungsNr'] . "," . $_GET['Nummer'] . "," . $_GET['Fassungsvermoegen']." , '" . $_GET['Ausstattung'] . "')";
        //Parse and execute statement
        //$stmt = $conn->prepare($sql);
        //$stmt->execute();
        $values = array(
            'AbteilungsNr' => $_GET['AbteilungsNr'],
            'Nummer' => $_GET['Nummer'],
            'Fassungsvermoegen' => $_GET['Fassungsvermoegen'],
            'Austattung' => $_GET['Austattung']
        );
        $db->Kueche->insert($values);
        echo "Successfully inserted!";
    }
    ?>
    <!--Suche-->
    <form id='searchform' class="example" action='kueche.php' method='get'>
        <br/>
        <a href="kueche.php">Alle Küchen</a>
        <br/>
        <br/>
        <label for="focusedInput">Suche nach Nummer der Küche: </label>
        <br/>
        <input class="form-control" id='search' type="text" name='search' placeholder="Search.." value='<?php if (isset($_GET['search']))
            echo $_GET['search'];?>'/>

        <button type="submit"><i class="fa fa-search"></i></button>
    </form>



    <!--IN SQL-->
    <?php
    // check if search view of list view

    // execute sql statement
    try{
        $search = $_GET['search'];
        if (isset($search)) {
            $sql = "SELECT * FROM imse_db.Kueche WHERE Nummer='" . $search ."'";
            // execute sql statement
            //$stmt = $conn->query($sql);
            //$stmt->execute();
            $query = array('Nummer' => $_GET['search']);
            $cursor = $db->Kueche->find($query);
        } else {
            //$sql = "SELECT * FROM imse_db.Kueche";
            // execute sql statement
            //$stmt = $conn->query($sql);
            //$stmt->execute();
            $cursor = $db->Kueche->find();
        }
    } catch(PDOException $e){
        //Print potential errors and warnings
        echo "Error: " . $e->getMessage();
    }
    ?>
    <!--Ausgabe-->
    <table>
        <thead>
        <tr>
            <h1>
                <th> AbteilungsNr  </th>
                <th> Nummer </th>
                <th> Fassungsvermoegen </th>
                <th> Ausstattung </th>
            </h1>
        </tr>
        </thead>
        <tbody>
        <?php
        // fetch rows of the executed sql query
        foreach ($cursor as $row) {
            echo "<tr>";
            echo "<td>" . $row['AbteilungsNr'] . "</td>";
            echo "<td>" . $row['Nummer'] . "</td>";
            echo "<td>" . $row['Fassungsvermoegen']. "</td>";
            echo "<td>" . $row['Ausstattung']. "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <!--ANZAHL-->
    <div>

        Insgesamt <?php echo $cursor->count(); ?> Küche(n) gefunden!

    </div>
    <?php
    //$stmt = null;
    //$conn = null;
    $cursor = null;
    ?>
</div>



</body>
</html>
