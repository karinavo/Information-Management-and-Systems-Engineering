<?php
header('Content-Type: text/x-csv');
header('Content-Disposition: attachment; filename="report.csv"');
header('Pragma: no-cache');
header('Expires: 0');

function gen_report_csv(MongoDB $db) {
    if (isset($_POST['Datum']) && isset($_POST['Thema']) && isset($_POST['ZeitBlock'])) {

    $kochkurse = $db->Kochkurse->find();
    $kursteilnehmer = $db->Kursteilnehmer->find();
    $findet_statt = $db->Findet_statt->find();

    $result = $conn->query(
        "SELECT Kochkurse.KursNr, Thema, Datum, ZeitBlock,(SELECT COUNT(*) FROM imse_db.Kursteilnehmer WHERE imse_db.Findet_statt.KursNr=imse_db.Kursteilnehmer.KursNr) AS Teilnehmerzahl
            FROM
                imse_db.Kochkurse
                    LEFT JOIN
                imse_db.Kursteilnehmer
                ON Kochkurse.KursNr = Kursteilnehmer.KursNr
                    INNER JOIN
                imse_db.Findet_statt
                    ON Kursteilnehmer.KursNr=Findet_statt.KursNr
                WHERE Datum=STR_TO_DATE('" . $_POST['Datum'] . "','%Y-%m-%d') AND Thema='".$_POST['Thema']."' AND ZeitBlock='".$_POST['ZeitBlock']."'".
                    "GROUP BY Kochkurse.KursNr
                    ORDER BY Teilnehmerzahl DESC;"
            );
    if (!$result) die('Couldn\'t fetch records');
        $num_fields = $result->columnCount();
        $headers = array();

        // getting the headers
        for ($i = 0; $i < $num_fields; $i++)
        {
            $col = $result->getColumnMeta($i);
            $headers[] = $col['name'];

        }

        //getting the data
        $fp = fopen('php://output', 'w');
        if ($fp && $result)
        {
            fputcsv($fp, $headers);

            while ($row = $result->fetch(PDO::FETCH_NUM)) {

                fputcsv($fp, array_values($row));
            }
        die;
        }
        return 'Succesfully created report.';
    } else {
        return "Geben Sie die Daten ein!";
        }
    }

function gen_report_csv(PDO $conn) {
    if (isset($_POST['Datum']) && isset($_POST['Thema']) && isset($_POST['ZeitBlock'])) {
    $result = $conn->query(
        "SELECT Kochkurse.KursNr,  Thema, Datum, ZeitBlock,(SELECT COUNT(*) FROM imse_db.Kursteilnehmer WHERE imse_db.Findet_statt.KursNr=imse_db.Kursteilnehmer.KursNr) AS Teilnehmerzahl
            FROM
                imse_db.Kochkurse
                    LEFT JOIN
                imse_db.Kursteilnehmer
                ON Kochkurse.KursNr = Kursteilnehmer.KursNr
                    INNER JOIN
                imse_db.Findet_statt
                    ON Kursteilnehmer.KursNr=Findet_statt.KursNr
                WHERE Datum=STR_TO_DATE('" . $_POST['Datum'] . "','%Y-%m-%d') AND Thema='".$_POST['Thema']."' AND ZeitBlock='".$_POST['ZeitBlock']."'".
                    "GROUP BY Kochkurse.KursNr
                    ORDER BY Teilnehmerzahl DESC;"
            );
    if (!$result) die('Couldn\'t fetch records');
        $num_fields = $result->columnCount();
        $headers = array();

        // getting the headers
        for ($i = 0; $i < $num_fields; $i++)
        {
            $col = $result->getColumnMeta($i);
            $headers[] = $col['name'];

        }

        //getting the data
        $fp = fopen('php://output', 'w');
        if ($fp && $result)
        {
            fputcsv($fp, $headers);

            while ($row = $result->fetch(PDO::FETCH_NUM)) {

                fputcsv($fp, array_values($row));
            }
        die;
        }
        return 'Succesfully created report.';
    } else {
        return "Geben Sie die Daten ein!";
        }
    }
/*
    $servername = "mariadb";
    $username = "root";
    $password = "rootpsw";
    $dbname = "imse_db";

try {
    $conn = new PDO(
    "mysql:host=$servername;$dbname;charset=utf8",
    $username,
    $password,
    array(PDO::ATTR_PERSISTENT => true));


    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}*/
////////// MONGO DB CONNECTION ///////////
// connect to mongodb
$m = new MongoClient();

echo "Connected to database succesfully";
// select a database
$db = $m->imse_mongodb;

echo "Database imse_mongodb selected";
////////// MONGO DB CONNECTION ///////////

    if (isset($_POST['reportsubmit'])) {
        gen_report_csv($conn);
    }
