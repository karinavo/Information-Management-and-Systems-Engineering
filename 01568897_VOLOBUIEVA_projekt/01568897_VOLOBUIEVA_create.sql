CREATE TABLE Kochschule (
  AbteilungsNr INTEGER CHECK ( AbteilungsNr>0),
  Name VARCHAR(25),
  Ort VARCHAR(25),
  PLZ NUMBER(5),
  Strasse VARCHAR(40),
  constraint kochschule_pk PRIMARY KEY(AbteilungsNr)
);

CREATE TABLE Kueche(
  AbteilungsNr  INTEGER NOT NULL,
  Nummer REAL CHECK (Nummer>0),
  Fassungsvermoegen NUMBER(2),
  Ausstattung VARCHAR2(90),
  CONSTRAINT kueche_fk FOREIGN KEY (AbteilungsNr)
  REFERENCES Kochschule(AbteilungsNr) ON DELETE CASCADE,
  CONSTRAINT kueche_pk PRIMARY KEY(AbteilungsNr,Nummer)
);

CREATE TABLE Mitarbeiter(
  MId INTEGER  CHECK (MId>0),
  Nachname CHAR(30),
  Vorname CHAR(30),
  Gehalt NUMBER(6,2) DEFAULT 1566,
  Strasse VARCHAR2(30),
  Ort VARCHAR2(25),
  PLZ NUMBER(5),
  Geburtsdatum DATE,
  LeiterMId INTEGER  CHECK (LeiterMId>0),
  AbteilungsNr INTEGER CHECK ( AbteilungsNr>0),
  CONSTRAINT mitarbeiter_pk  PRIMARY KEY(MId),
  CONSTRAINT leiter_fk  FOREIGN KEY(LeiterMId) REFERENCES Mitarbeiter(MId),
  CONSTRAINT mitarbeiter_fk FOREIGN KEY (AbteilungsNr) REFERENCES Kochschule(AbteilungsNr)
);

CREATE TABLE Manager(
  SVNummer NUMBER(20),
  EMail VARCHAR2(90) CHECK(REGEXP_LIKE(EMail,'[[:alnum:]]+@[[:alnum:]]+\.[[:alnum:]]')),
  Telefonummer VARCHAR2(20) UNIQUE,
  MId INTEGER  UNIQUE NOT NULL,
  CONSTRAINT manager_pk PRIMARY KEY(SVNummer),
  CONSTRAINT manager_fk FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE
);

CREATE TABLE Koch(
  KochID INTEGER
       CONSTRAINT koch_pk PRIMARY KEY,
  Rang CHAR(25),
  Ausbildung VARCHAR2(40),
  MId INTEGER UNIQUE NOT NULL,
  CONSTRAINT koch_fk FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE,
  CHECK(KochID>0)
);

CREATE TABLE Kochkurse(
  KursNr INTEGER PRIMARY KEY,
  Preis  NUMERIC(5,2) DEFAULT 120,
  Thema VARCHAR2(80),
  SVNummer NUMBER(20)  NOT NULL ,
  CONSTRAINT kochkurse_fk FOREIGN KEY(SVNummer) REFERENCES Manager(SVNummer) ON DELETE CASCADE
);

CREATE TABLE Kursteilnehmer(
  KursteilnehmerNr INTEGER ,
  Vorname CHAR(30),
  Nachname CHAR(30),
  EMail VARCHAR2(40) CHECK(REGEXP_LIKE(EMail,'[[:alnum:]]+@[[:alnum:]]+\.[[:alnum:]]')),
  TelefonNr VARCHAR2(14) UNIQUE,
  AbteilungsNr INTEGER NOT NULL,
  KursNr INTEGER NOT NULL,
  CONSTRAINT kursteilnehmer_pk PRIMARY KEY (KursteilnehmerNr),
  CONSTRAINT kursteilnehmer_a_fk FOREIGN KEY (AbteilungsNr) REFERENCES  Kochschule (AbteilungsNr) ON DELETE CASCADE,
  CONSTRAINT kursteilnehmnr_kn_fk FOREIGN KEY (KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE
);

CREATE TABLE Zeit(
  ZeitBlock  VARCHAR(14)
    CONSTRAINT zb CHECK (ZeitBlock in ('1. 10:00-14:00','2. 14:15-18:15','3. 18:30-22:30')),
  Datum DATE,
  PRIMARY KEY(ZeitBlock,Datum)
);
CREATE TABLE Findet_statt(
  ZeitBlock VARCHAR(14) CONSTRAINT fs_zb CHECK (ZeitBlock in ('1. 10:00-14:00','2. 14:15-18:15','3. 18:30-22:30')),
  Datum DATE,
  KursNr INTEGER,
  Nummer REAL,
  AbteilungsNr INTEGER,
  FOREIGN KEY(ZeitBlock,Datum)  REFERENCES Zeit(ZeitBlock,Datum) ON DELETE CASCADE,
  CONSTRAINT fs_kurs_fk FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  CONSTRAINT fs_kueche_fk FOREIGN KEY(Nummer,AbteilungsNr) REFERENCES Kueche(Nummer,AbteilungsNr) ON DELETE CASCADE,
  PRIMARY KEY(ZeitBlock,Datum,KursNr)
);

CREATE TABLE Fuehrt(
  KochID INTEGER,
  KursNr INTEGER,
  CONSTRAINT fuehrt_koch_fk FOREIGN KEY(KochID) REFERENCES Koch(KochID) ON DELETE CASCADE,
  CONSTRAINT fuehrt_kurs_fk FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  PRIMARY KEY(KochID,KursNr)
 );

/** „auto-increment“ Funktionen **/

CREATE SEQUENCE kochschule_seq
INCREMENT BY 1
START WITH 1;

CREATE SEQUENCE seq_mid
  INCREMENT BY 1
  START WITH 1;

CREATE SEQUENCE kochkurse_seq
INCREMENT BY 1
START WITH 1;

CREATE SEQUENCE kunde_seq
INCREMENT BY 1
START WITH 1;




CREATE OR REPLACE trigger kochschule_trigger
  BEFORE INSERT ON Kochschule
  FOR EACH ROW
  BEGIN
    SELECT  kochschule_seq.nextval
               INTO :new.AbteilungsNr
               FROM dual;
  END;
/
CREATE OR REPLACE TRIGGER trigger_mid
  BEFORE INSERT ON Mitarbeiter
  FOR EACH ROW
   DECLARE my_seq Mitarbeiter.MId%type;
  BEGIN
     SELECT seq_mid.nextval INTO my_seq FROM DUAL;
     :new.MId := my_seq;
   END;
/
CREATE SEQUENCE koch_seq
INCREMENT BY 1
START WITH 1;
CREATE OR REPLACE trigger koch_trigger
  BEFORE INSERT ON Koch
  FOR EACH ROW
  BEGIN
    SELECT koch_seq.nextval
               INTO :new.KochID
               FROM dual;
  END;
/
CREATE OR REPLACE trigger kochkurse_trigger
  BEFORE INSERT ON Kochkurse
  FOR EACH ROW
  BEGIN
    SELECT kochkurse_seq.nextval
               INTO :new.KursNr
               FROM dual;
  END;

/
CREATE OR REPLACE trigger kunde_trigger
  BEFORE INSERT ON Kursteilnehmer
  FOR EACH ROW
  BEGIN
    SELECT kunde_seq.nextval
               INTO :new.KursteilnehmerNr
               FROM dual;
  END;

/




/***********************Views**************/
/*1. Zählt die Anzahl von  Mitarbeiter*/
CREATE VIEW anzahl_mitaebeiter(Anzahl) AS
SELECT COUNT(MId) FROM Mitarbeiter;
/*2.Zeigt Durchschnittsgehalt*/
CREATE VIEW avg_gehalt(AverageSalary) AS
SELECT AVG(Gehalt) FROM Mitarbeiter;
/*3.Zeig die ID von Koch,der  mehr als 1 Kurs am selben Tag hat*/
CREATE VIEW anzahl_kochkurse(AnzKurse,KochID,Datum) AS
SELECT COUNT(Fuehrt.KursNr),KochID, Datum
FROM Fuehrt INNER JOIN Findet_statt ON Fuehrt.KursNr=Findet_statt.KursNr
GROUP BY KochID,Findet_statt.Datum
HAVING COUNT(Findet_statt.KursNr)>1;





