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

   $collection = $db->Koch;

   ////////// MONGO DB CONNECTION ///////////
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
        <p class="oblique" > Die Köche</p>
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
        <form id='insertform' action='koch.php' method='get'>
            Neuer Koch einfuegen:
            <table>
                <thead>
                <tr>
                    <th>Rang</th>
                    <th>Ausbildung</th>
                    <th>MId</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input id='Rang' name='Rang' type='text' size='10' value='<?php echo $_GET['Rang']; ?>' />
                    </td>
                    <td>
                        <input id="Ausbildung" name="Ausbildung" type="text" size="10" value="<?php   echo $_GET['Ausbildung'];?>"/>
                    </td>
                    <td>
                        <input id="MId" name="MId" type="number" size="10" value="<?php  echo $_GET['MId'];?>"/>
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
    if(isset($_GET['MId'])) {
        //Prepare insert statementd
        //$sql="INSERT INTO imse_db.Koch(Rang,Ausbildung,MId) VALUES('". $_GET['Rang'] ."','" . $_GET['Ausbildung']."'," . $_GET['MId'] . ")";
        //Parse and execute statement
        //$insertOne = $conn->prepare($sql);
        $values = array(
            'Rand' => $_GET['Rang'],
            'Ausbildung' => $_GET['Ausbildung'],
            'MId' => $_GET['MId']
        );
        $collection->insertOne($values);
    }
    ?>
    <!--Suche-->
    <form id='searchform' class="example" action='koch.php' method='get'>
        <br/>
        <a href="koch.php">Alle Koeche</a>
        <br/>
        <br/>
        <label for="focusedInput">Suche nach KochID des Kochs: </label>
        <br/>
        <input class="form-control" id='search' type="text" name='search' placeholder="Search.." value='<?php if (isset($_GET['search']))
            echo $_GET['search'];?>'/>

        <button type="submit"><i class="fa fa-search"></i></button>
    </form>



    <!--IN SQL-->
    <?php
    // check if search view of list view
    if (isset($_GET['search'])) {
        //$sql = "SELECT * FROM imse_db.Koch WHERE KochID='" . $_GET['search'] . "'";
        $where = array('KochID' => $_GET['search']);
        $cursor = $collection->find($where);
    } else {
        //$sql = "SELECT * FROM imse_db.Koch";
        $cursor = $collection->find();
    }
    // execute sql statement
    //$stmt = $conn->prepare($sql);
    //$stmt->execute();
    ?>
    <!--Ausgabe-->
    <table>
        <thead>
        <tr>
            <h1>
                <th> KochID </th>
                <th> Rang </th>
                <th> Ausbildung </th>
                <th> MId </th>
            </h1>
        </tr>
        </thead>
        <tbody>
        <?php
        // fetch rows of the executed sql query
        foreach ($cursor as $row) {
            echo "<tr>";
            echo "<td>" . $row['KochID'] . "</td>";
            echo "<td>" . $row['Rang'] . "</td>";
            echo "<td>" . $row['Ausbildung']. "</td>";
            echo "<td><a href='mitarbeiter.php?search=" . $row['MId'] . "'>" . $row['MId'] . "</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <!--ANZAHL-->
    <div>

        Insgesamt <?php echo count($cursor->toArray()); ?> Koch(e) gefunden!


    </div>
    <?php
    //$stmt = null;
    //$conn = null;
    $cursor = null;
    ?>

</div>



</body>
</html>
