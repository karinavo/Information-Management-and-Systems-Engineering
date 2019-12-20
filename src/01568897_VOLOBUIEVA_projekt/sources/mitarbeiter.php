<!DOCTYPE html>
<?php
$user = 'root';
$pass = 'rootpsw';
$database = 'imse_db';

// establish database connection
$conn = mysqli_connect($user, $pass, $database);
if (!$conn) exit;
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
        /*Fixed sidenav,full height*/
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
        /* Style the sidenav links and the dropdown button */
        .sidenav a, .dropdown-btn{
            padding: 6px 8px 6px 16px;
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
        };
        }
        .sidenav a:hover,.dropdown-btn:hover{
            color: bisque;
        }
        .main{
            margin-left: 200px; /* Same as the width of the sidenav */
            font-size: 20px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }
        .active{
            background-color: #4d4d4d;
            color: bisque;
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
        <p class="oblique" > Die Mitarbeiter</p>
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

    <button class="dropdown-btn"> &#9778;
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container" style="margin-left: 6%">
        <a href="index.php">Home</a>
        <a href="kueche.php">Küche</a>
        <a href="kochkurse.php">Kochkurse</a>
        <a href="koch.php">Unsere Köche</a>
        <a href="findetstatt.php">Termine</a>
        <a href="fuehrt.php">Fuehrung</a>
        <a href="kursteilnehmer.php">Kursteilnehmer</a>
        <a href="mitarbeiter.php">Mitarbeiter</a>
    </div>
</div>
<div class="main">
    <!--Insert Formular-->
    <div>
        <form id='insertform' action='mitarbeiter.php' method='get'>
            Neuer Mitarbeiter einfuegen:
            <table>
                <thead>
                <tr>
                    <h1>

                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>Gehalt</th>
                        <th>Strasse</th>
                        <th>Ort</th>
                        <th>PLZ</th>
                        <th>Geburtsdatum</th>
                        <th>Leiter-MId</th>
                        <th>AbteilungsNr</th>
                    </h1>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input id='Nachname' name='Nachname' type='text' size='10' value='<?php echo $_GET['Nachname']; ?>' />
                    </td>
                    <td>
                        <input id="Vorname" name="Vorname" type="text" size="10" value="<?php   echo $_GET['Vorname'];?>"/>
                    </td>
                    <td>
                        <input id="Gehalt" name="Gehalt" type="number" size="10" value="<?php  echo $_GET['Gehalt'];?>"/>
                    </td>
                    <td>
                        <input id="Strasse" name="Strasse" type="text" size="10"
                               value="<?php echo $_GET['Nummer'];?>"/>
                    </td>
                    <td>
                        <input id="Ort" name="Ort" type="text" size="10"
                               value="<?php echo $_GET['Ort'];?>"/>
                    </td>
                    <td>
                        <input id="PLZ" name="PLZ" type="number" size="10" value="<?php  echo $_GET['PLZ'];?>"/>
                    </td>
                    <td>
                        <input id="Geburtsdatum" name="Geburtsdatum" type="text" size="10"
                               value="<?php echo $_GET['Geburtsdatum'];?>"/>
                    </td>

                    <td>
                        <input id="LeiterMId" name="LeiterMId" type="number" size="10" value="<?php  echo $_GET['LeiterMId'];?>"/>
                    </td>
                    <td>
                        <input id="AbteilungsNr" name="AbteilungsNr" type="number" size="10" value="<?php  echo $_GET['AbteilungsNr'];?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <input class="buttoninsert" id='submit1' type='submit' value='Insert'  />
        </form>
    </div>
    <!--In SQL for Insert-->
    <?php
    //HANDLE insert
    if(isset($_GET['AbteilungsNr'])) {
        //Prepare insert statementd
        $sql="INSERT INTO Mitarbeiter(Nachname,Vorname,Gehalt,Strasse,Ort,PLZ,Geburtsdatum,LeiterMId,AbteilungsNr) 
            VALUES('". $_GET['Nachname'] ."','". $_GET['Vorname']."',". $_GET['Gehalt'].",'".$_GET['Strasse']."','".$_GET['Ort']."',".
            $_GET['PLZ'].",TO_DATE('" . $_GET['Geburtsdatum'] . "','YYYY/MM/DD')," . $_GET['LeiterMId'] . "," . $_GET['AbteilungsNr']. ")";

        //Parse and execute statement
        $insert = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($insert);
        $conn_err=mysqli_error($conn);
        $insert_err=mysqli_error($insert);
        if(!$conn_err & !$insert_err){
            print("Successfully inserted");
            print("<br>");
        }
        //Print potential errors and warnings
        else{
            print($conn_err);
            print_r($insert_err);
            print("<br>");
        }
        mysqli_free_result($insert);
    }
    ?>

    <!--Suche-->
    <form id='searchform' class="example" action='mitarbeiter.php' method='get'>

        <a href="mitarbeiter.php">Alle Mitarbeiter</a>
        <br/>
        <label for="focusedInput">Suche nach MId der Mitarbeiter: </label>
        <br/>
        <input class="form-control" id='search' type="text" name='search' placeholder="Search.." value='<?php if (isset($_GET['search']))
            echo $_GET['search'];?>'/>

        <button type="submit"><i class="fa fa-search"></i></button>
    </form>



    <!--IN SQL-->
    <?php
    // check if search view of list view
    if (isset($_GET['search'])) {
        $sql = "SELECT * FROM Mitarbeiter WHERE MId like '%" . $_GET['search'] . "%'";
    } else {
        $sql = "SELECT * FROM Mitarbeiter";
    }
    // execute sql statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    ?>
    <!--Ausgabe-->
    <table>
        <thead>
        <tr>
            <h1>
                <th>MId</th>
                <th>Nachname</th>
                <th>Vorname</th>
                <th>Gehalt</th>
                <th>Strasse</th>
                <th>Ort</th>
                <th>PLZ</th>
                <th>Geburtsdatum</th>
                <th>Leiter-MId</th>
                <th>AbteilungsNr</th>
            </h1>
        </tr>
        </thead>
        <tbody>
        <?php
        // fetch rows of the executed sql query
        while ($row = mysqli_fetch_assoc($stmt)) {
            echo "<tr>";

            echo "<td>" . $row['MID'] . "</td>";
            echo "<td>" . $row['NACHNAME']. "</td>";
            echo "<td>" . $row['VORNAME']. "</td>";
            echo "<td>" . $row['GEHALT']. "</td>";
            echo "<td>" . $row['STRASSE']. "</td>";
            echo "<td>" . $row['ORT']. "</td>";
            echo "<td>" . $row['PLZ']. "</td>";
            echo "<td>" . $row['GEBURTSDATUM']. "</td>";
            echo "<td>" . $row['LEITERMID']. "</td>";
            echo "<td>" . $row['ABTEILUNGSNR'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <!--ANZAHL-->
    <div>

        Insgesamt <?php echo mysqli_num_rows($stmt); ?> Mitarbeiter gefunden!

    </div>
    <?php
    mysqli_free_result($stmt);
    mysqli_close($conn);
    ?>
</div>
<!--menu of school-->
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>


</body>
</html>