<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
   ////////// MONGO DB CONNECTION ///////////
   // connect to mongodb
   $m = new MongoDB\Driver\Manager("mongodb://localhost:27017");

   echo "Connected to database successfully";
   // select a database
   $db = $m->imse_mongodb;

   echo "Database imse_mongodb selected";
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
        <p class="oblique" > Der Bericht</p>
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

</head>


<body>
<!--background-->
<div class="sidenav">
    <div class="dropdown">
        <button class="dropdown-btn">
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

    <!--Report Formular-->

    <script>
        function resetForm() {
            document.getElementById("berichtform").reset();
        }
    </script>








    <?php
    //$query_zb = "SELECT DISTINCT ZeitBlock FROM imse_db.Zeit;";
    //$query_thema ="SELECT DISTINCT Thema FROM imse_db.Kochkurse;";
    // execute sql for zeitbloc statement
    //$stmt_zb = $conn->prepare($query_zb);
    //$stmt_zb->execute();
    // execute sql for thema statement
    //$stmt_thema= $conn->prepare($query_thema);
    //$stmt_thema->execute();
    ?>

    <?php
    $query_zb = $db->Zeit->find(array(), ['ZeitBlock' => true])->distinct();
    $query_thema =$db->Kochkurse->find(array(), ['Thema' => true])->distinct();
     ?>



    <!-- Button for reporting use case -->
    <div>
        <br/>
        <form id="berichtform" action="report.php/?reportsubmit=true" method="post">
            Wählen Sie bitte aus:
            <table>
                <thead>
                <tr>

                    <th>Datum</th>
                    <th>Thema</th>
                    <th>ZeitBlock</th>

                </tr>
                </thead>
                <tbody>
                <tr>

                    <td>
                        <INPUT TYPE="date" name="Datum" VALUE="<?php $_GET['Datum'];?>"">

                    </td>
                    <td>
                        <INPUT TYPE="text" name="Thema" list="themas">
                        <datalist id="themas">
                        <?php
                            foreach ($query_thema as $row)
                        {
                            echo '<option value=" '.$row['Thema'].' " </option>';
                        }
                        ?>
                        </datalist>
                    </td>
                    <td>
                        <INPUT TYPE="text" name="ZeitBlock" list="zeitblocks">
                        <datalist id="zeitblocks">
                        <?php
                        foreach ($query_zb as $row)
                        {
                            echo '<option value=" '.$row['ZeitBlock'].' " </option>';
                        }
                        ?>
                        </datalist>
                    </td>
                </tr>
                </tbody>
            </table>

            <input type="submit" class="buttoninsert"  name="reportsubmit"  value='Generiere Bericht'  />

            <input class="buttoninsert" type="button" onclick="resetForm()" value="Clear fields">

        </form>
    </div>
    <?php

    //$stmt = null;
    //$conn = null;
    ?>

</div>



</body>
</html>
