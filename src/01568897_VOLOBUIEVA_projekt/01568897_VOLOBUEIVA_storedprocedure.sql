/*Stored Procedure for Findet_statt*/
CREATE OR REPLACE PROCEDURE abt_strasse(abt IN INTEGER,str OUT VARCHAR) IS
BEGIN
  SELECT ks.Strasse INTO str FROM Kochschule ks
  WHERE abt=ks.AbteilungsNr;
end;
/
/*Stored Procedure for Kochkurse*/
  CREATE OR REPLACE PROCEDURE kontakten(nr IN INTEGER, svn IN NUMBER,nn OUT CHAR, vn OUT CHAR,email OUT VARCHAR2, tlf OUT VARCHAR2) IS
BEGIN
  SELECT marb.Nachname,marb.Vorname, mng.EMail,mng.Telefonummer INTO nn,vn, email,tlf  FROM  Kochkurse krs,Manager mng, Koch kch, Fuehrt f, Mitarbeiter marb
          WHERE krs.KursNr=nr AND krs.KursNr=f.KursNr AND f.KochID=kch.KochID AND  kch.MId=marb.MId AND
                krs.SVNummer=svn AND mng.SVNummer=svn;
end;
/

