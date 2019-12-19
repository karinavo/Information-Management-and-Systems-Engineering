<!DOCTYPE html>
<?php
$user = 'a01568897';
$pass = 'karina39';
$database = 'lab';

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
            font-family:  "TeX Gyre ", serif; 
            font-size: 65%; 
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
        <p class="oblique" > Die Termine</p>
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
        <form id='insertform' action='findetstatt.php' method='get'>
            Neuer Termin einfuegen:
            <table>
                <thead>
                <tr>
                    <th>ZeitBlock</th>
                    <th>Datum</th>
                    <th>KursNr</th>
                    <th>Nummer </th>
                    <th>AbteilungsNr </th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input id='ZeitBlock' name='ZeitBlock' type='text' size='10' value='<?php echo $_GET['ZeitBlock']; ?>' />
                    </td>
                    <td>
                        <input id="Datum" name="Datum" type="text" size="10" value="<?php   echo $_GET['Datum'];?>"/>
                    </td>
                    <td>
                        <input id=" KursNr" name="KursNr" type="number" size="10" value="<?php  echo $_GET['KursNr'];?>"/>
                    </td>
                    <td>
                        <input id="Nummer" name="Nummer" type="number" size="10"
                                    value="<?php echo $_GET['Nummer'];?>"/>
                    </td>
                    <td>
                        <input id="AbteilungsNr" name="AbteilungsNr" type="number" size="10"
                                    value="<?php echo $_GET['AbteilungsNr'];?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <input class="buttoninsert" id='submit' type='submit' value='Insert'  />
        </form>
    </div>
    <!--In SQL for Insert-->
    <?php
    //HANDLE insert
    if(isset($_GET['ZeitBlock'])&&isset($_GET['Datum'])&&isset($_GET['KursNr'])) {
        //Prepare insert statementd
        $sql="INSERT INTO Findet_statt VALUES('". $_GET['ZeitBlock'] ."',TO_DATE('" . $_GET['Datum'] . "','YYYY/MM/DD')," . $_GET['KursNr'] . "," . $_GET['Nummer'] . "," . $_GET['AbteilungsNr'] . ")";
        //Parse and execute statement
        $insert = mysqli_parse($conn, $sql);
        mysqli_execute($insert);
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
        mysqli_free_statement($insert);
    }
    ?>  <!--Stored Procedure-->
    <div>
        <form id="searchstr" action="findetstatt.php" method="get">
            Suche Strasse von Koschschule(AbteilungsNr):
            <input id="AbteilungsNr" name="AbteilungsNr" type="text" size="10"
                   value="<?php echo $_GET['AbteilungsNr']; ?>"/>
            <input class ="buttoninsert" id='submit' type='submit' value='Aufruf Stored Procedure!' />
            <br>
        </form>
    </div>
    <!-- PHP-Code mit dem Aufruf der Stored Procedure-->
    <?php
    //Handle Stored Procedure
    if (isset($_GET['AbteilungsNr']))
    {
        //Call Stored Procedure
        $abt = $_GET['AbteilungsNr'];
        $str='';
        $sproc = mysqli_parse($conn, 'begin abt_strasse(:p1, :p2); end;');
        //Bind variables, p1=input (abt), p2=output (str)
        mysqli_bind_by_name($sproc, ':p1', $abt);
        mysqli_bind_by_name($sproc, ':p2', $str, 25);
        mysqli_execute($sproc);
        $conn_err=mysqli_error($conn);
        $proc_err=mysqli_error($sproc);
        //If there have been no Connection or Database errors, print department
        if(!$conn_err && !$proc_err){
            echo("<br><b>". "Die Kochschule Nr." . $abt . " befindet sich auf der  " . $str . "</b><br>" );  // prints OUT parameter of stored procedure
        }
        else{
            //Print potential errors and warnings
            print($conn_err);
            print_r($proc_err);
        }
    }
    // clean up connections
    mysqli_free_statement($sproc);

    ?>
    <!--Suche-->
    <form id='searchform' class="example" action='findetstatt.php' method='get'>

        <a href="findetstatt.php">Alle Termine</a>
        <br/>
        <label for="focusedInput">Suche nach Datum des Termins: </label>
        <br/>
        <input class="form-control" id='search' type="text" name='search' placeholder="Search.." value='<?php if (isset($_GET['search']))
            echo $_GET['search'];?>'/>

        <button type="submit"><i class="fa fa-search"></i></button>
    </form>



    <!--IN SQL-->
    <?php
    // check if search view of list view
    if (isset($_GET['search'])) {
        $sql = "SELECT * FROM Findet_statt WHERE Datum like '%" . $_GET['search'] . "%'";
    } else {
        $sql = "SELECT * FROM Findet_statt";
    }
    // execute sql statement
    $stmt = mysqli_parse($conn, $sql);
    mysqli_execute($stmt);
    ?>
    <!--Ausgabe-->
    <table>
        <thead>
        <tr>
            <h1>
                <th> Zeit </th>
                <th> Datum </th>
                <th> KursNr </th>
                <th> Nummer von Kueche </th>
                <th> AbteilungsNr von Kochschule </th>
            </h1>
        </tr>
        </thead>
        <tbody>
        <?php
        // fetch rows of the executed sql query
        while ($row = mysqli_fetch_assoc($stmt)) {
            echo "<tr>";
            echo "<td>" . $row['ZEITBLOCK'] . "</td>";
            echo "<td>" . $row['DATUM'] . "</td>";
            echo "<td>" . $row['KURSNR']. "</td>";
            echo "<td>" . $row['NUMMER']. "</td>";
            echo "<td>" . $row['ABTEILUNGSNR']. "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <!--ANZAHL-->
    <div>

        Insgesamt <?php echo mysqli_num_rows($stmt); ?> Termin(e) gefunden!

    </div>
    <?php  mysqli_free_statement($stmt); mysqli_close($conn); ?>
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
