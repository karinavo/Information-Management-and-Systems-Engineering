<?php 
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

            header('Content-Type: text/x-csv');
            header('Content-Disposition: attachment; filename="report.csv"');
            header('Pragma: no-cache');    
            header('Expires: 0');
        die; 
        }
        return 'Succesfully created report.'; 
    }