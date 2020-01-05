/*SELECT 
  Kochkurse.KursNr, Thema, ZeitBlock, Datum, 
  COUNT(KursteilnehmerNr) AS Teilnehmerzahl
FROM Findet_statt NATURAL JOIN (
  Kochkurse NATURAL JOIN Kursteilnehmer
)
ORDER BY Teilnehmerzahl;
*/
/* ODER 
SELECT Kochkurse.KursNr, Thema, Datum, ZeitBlock, Teilnehmerzahl
FROM Findet_statt NATURAL JOIN (
  SELECT KursNr, Thema, COUNT(KursteilnehmerNr) AS Teilnehmerzahl 
FROM (Kochkurse NATURAL JOIN Kursteilnehmer)) ON Findet_statt.KursNr = Kochkurse.KursNr = Kursteilnehmer.KursNr;
*/
/*SELECT Kochkurse.KursNr, Thema, COUNT(KursteilnehmerNr) AS Teilnehmerzahl  FROM Kochkurse INNER JOIN Kursteilnehmer ON Kochkurse.KursNr=Kursteilnehmer.KursNr;*/

select Kochkurse.KursNr, Thema, Datum, ZeitBlock, COUNT(Kursteilnehmer.KursNr) AS Teilnehmerzahl
from
    Kochkurse
        left join
    Kursteilnehmer
        on Kochkurse.KursNr = Kursteilnehmer.KursNr
        inner join 
    Findet_statt
        on Kursteilnehmer.KursNr = Findet_statt.KursNr
        GROUP BY Kochkurse.KursNr
        ORDER BY Teilnehmerzahl DESC;