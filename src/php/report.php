<?php 
header('Content-Type: text/x-csv');
header('Content-Disposition: attachment; filename="report.csv"');
header('Pragma: no-cache');    
header('Expires: 0');

function gen_report_csv(PDO $conn) {
                
    $result = $conn->query(
            "SELECT Kochkurse.KursNr, Thema, ZeitBlock, Datum, COUNT(KursteilnehmerNr) AS Teilnehmerzahl 
            FROM (imse_db.Findet_statt NATURAL JOIN ( imse_db.Kochkurse NATURAL JOIN imse_db.Kursteilnehmer)) 
            ORDER BY Teilnehmerzahl;"
            ); 

        if (!$result) die('Couldn\'t fetch records'); 
        $num_fields = $result->columnCount(); 
        $headers = array(); 
        
        // getting the headers
        for ($i = 0; $i < $num_fields; $i++) 
        {     
            $col = $result->getColumnMeta($i);
            $$headers[] = $col['name'];
        } 

        //getting the data
        $fp = fopen('php://output', 'w'); 
        if ($fp && $result) 
        {     
            fputcsv($fp, $headers); 
            
            while ($row = $result->fetch()) {
                fputcsv($fp, array_values($row)); 
            }
        die; 
        }
        return 'Succesfully created report.'; 
    }

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
}

    if (isset($_POST['reportsubmit'])) {
        gen_report_csv($conn);
    }