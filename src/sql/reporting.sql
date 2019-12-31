SELECT 
  Kochkurse.KursNr, Thema, ZeitBlock, Datum, 
  COUNT(KursteilnehmerNr) AS Teilnehmerzahl
FROM Findet_statt NATURAL JOIN (
  Kochkurse NATURAL JOIN Kursteilnehmer
)
ORDER BY Teilnehmerzahl;

/* ODER */
SELECT Kochkurse.KursNr, Thema, Datum, ZeitBlock, Teilnehmerzahl
FROM Findet_statt INNER JOIN (
  SELECT KursNr, Thema, COUNT(KursteilnehmerNr) AS Teilnehmerzahl 
FROM (Kochkurse NATURAL JOIN Kursteilnehmer)) ON Findet_statt.KursNr = Kochkurse.KursNr;

/*SELECT Kochkurse.KursNr, Thema, COUNT(KursteilnehmerNr) AS Teilnehmerzahl  FROM Kochkurse INNER JOIN Kursteilnehmer ON Kochkurse.KursNr=Kursteilnehmer.KursNr;*/