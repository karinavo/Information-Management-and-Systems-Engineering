<!DOCTYPE html>
<?php
$servername = "mariadb";
$username = "root";
$password = "rootpsw";
$dbname = "imse_db";
try {
    $conn = new PDO("mysql:host=$servername;$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
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
        <p class="oblique" > Die Kochkurse</p>
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
        <form id='insertform' action='kochkurse.php' method='get'>
            Neuer Kochkurs einfuegen:
            <table>
                <thead>
                <tr>

                    <th>Preis</th>
                    <th>Thema</th>
                    <th>SVNummer</th>

                </tr>
                </thead>
                <tbody>
                <tr>

                    <td>
                        <input id="Preis" name="Preis" type="number" size="10" value="<?php   echo $_GET['Preis'];?>"/>
                    </td>
                    <td>
                        <input id="Thema" name="Thema" type="text" size="10" value="<?php  echo $_GET['Thema'];?>"/>
                    </td>
                    <td>
                        <input id="SVNummer" name="SVNummer" type="text" size="10" value="<?php echo $_GET['SVNummer'];?>"/>
                    </td>
                </tr>
                </tbody>
            </table>

            <input class="buttoninsert" id='submit3' type='submit' value='Insert'  />
        </form>
    </div>
    <!--In SQL for Insert-->
    <?php
    //HANDLE insert
    if(isset($_GET['Thema'])) {
        //Prepare insert statementd
        $sql="INSERT INTO Kochkurse(Preis,Thema,SVNummer) VALUES(" . $_GET['Preis'] . ",'" . $_GET['Thema'] . "'," . $_GET['SVNummer'] . ")";
        //Parse and execute statement
        $insert = $conn->prepare($sql);
        $insert->execute($insert);
        $conn_err=$conn->errorInfo();
        $insert_err=$insert->errorInfo();
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
        //oci_free_statement($insert);
    }
    ?>
    <!--Stored Procedure-->
    <div>
        <form id="searchstr" action="kochkurse.php" method="get">
            Suche der Nachname und der Vorname von Koch, der dieser Kurs führt(KursNr):
            <br>
            <input id="KursNr" name="KursNr" type="text" size="10"
                   value="<?php echo $_GET['KursNr']; ?>"/>
            <br>
            und Kontakte von Manager, der dieser Kurs organisiert(SVNummer):<br>
            <input id="SVNummer2" name="SVNummer" type="text" size="10"
                   value="<?php echo $_GET['SVNummer']; ?>"/>
            <br>
            <input class ="buttoninsert" id='submit1' type='submit' value='Aufruf Stored Procedure!' />
        </form>
    </div>
    <!-- PHP-Code mit dem Aufruf der Stored Procedure-->
    <?php
    //Handle Stored Procedure
    if (isset($_GET['KursNr'])&&isset($_GET['SVNummer']))
    {
        //Call Stored Procedure
        //IN

        $kursnr = $_GET['KursNr'];
        $svnr = $_GET['SVNummer'];

        //OUT
        $nachname='';
        $vorname = '';
        $email='';
        $tlfnr='';

        $sproc = $conn->prepare("begin kontakten(:p1, :p2,:p3,:p4,:p5,:p6); end;");
        //Bind variables

        $sproc->bindParam(':p1', $kursnr);
        $sproc->bindParam(':p2', $svnr);
        $sproc->bindParam(':p3', $nachname,30);
        $sproc->bindParam(':p4', $vorname,30);
        $sproc->bindParam(':p5', $email,80);
        $sproc->bindParam(':p6', $tlfnr,14);


        $insert->execute($sproc);



        $conn_err=$conn->errorInfo();
        $proc_err=$sproc->errorInfo();
        //If there have been no Connection or Database errors, print department
        if(!$conn_err && !$proc_err){
            echo("<br><b>". "Der Koch " . $nachname . " " . $vorname ." fuehrt Kurs " . $kursnr. "</b><br>" );  // prints OUT parameter of stored procedure
            echo("<br><b>". "Jetz buchen: " . $tlfnr . " oder " . $email . "</b><br>" );
        }
        else{
            //Print potential errors and warnings
            print($conn_err);
            print_r($proc_err);
        }
    }

    // clean up connections
    //oci_free_statement($sproc);
   ;

    ?>
   <!--Suche-->
    <form id='searchform' class="example" action='kochkurse.php' method='get'>

        <a href="kochkurse.php">Alle Kochkurse</a>
        <br/>
        <label for="focusedInput">Suche nach Thema des Kochkurses: </label>
        <input class="form-control" id='search' type="text" name='search' placeholder="Search.." value='<?php if (isset($_GET['search']))
                                                                                                echo $_GET['search'];?>'/>

        <button type="submit"><i class="fa fa-search"></i></button>
    </form>



<!--IN SQL-->
<?php
// check if search view of list view
if (isset($_GET['search'])) {
    $sql = "SELECT * FROM Kochkurse WHERE Thema like '%" . $_GET['search'] . "%'";
} else {
    $sql = "SELECT * FROM Kochkurse";
}
// execute sql statement
$stmt = $conn->prepare($sql);
$insert->execute($stmt);
?>
<!--Ausgabe-->
<table>
    <thead>
        <tr>
            <h1>
                <th> KursNr </th>
                <th> Preis </th>
                <th> Thema </th>
                <th> SVNummer </th>
            </h1>
        </tr>
    </thead>
    <tbody>
        <?php
        // fetch rows of the executed sql query
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['KURSNR'] . "</td>";
            echo "<td>" . $row['PREIS'] . "</td>";
            echo "<td>" . $row['THEMA']. "</td>";
            echo "<td>" . $row['SVNUMMER']. "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
    <!--ANZAHL-->
    <div>

            Insgesamt <?php echo $stmt->rowCount(); ?> Kochkurs(e) gefunden!

    </div>
    <?php
        //oci_free_statement($stmt);
        //oci_close($conn);
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
