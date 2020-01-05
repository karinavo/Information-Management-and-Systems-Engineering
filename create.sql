CREATE TABLE Kochschule (
  AbteilungsNr INTEGER AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(25),
  Ort VARCHAR(25),
  PLZ INT(5),
  Strasse VARCHAR(40),
);
/* CREATE TABLE Kueche(
  AbteilungsNr  INTEGER NOT NULL,
  Nummer  DOUBLE PRECISION,
  Fassungsvermoegen INT(2),
  Ausstattung VARCHAR(90),
  PRIMARY KEY(AbteilungsNr,Nummer),
  FOREIGN KEY (AbteilungsNr) REFERENCES Kochschule(AbteilungsNr)
);
CREATE TABLE Mitarbeiter(
  MId INTEGER AUTO_INCREMENT,
  Nachname CHAR(30),
  Vorname CHAR(30),
  Gehalt DECIMAL(6,2) DEFAULT 1566,
  Strasse VARCHAR(30),
  Ort VARCHAR(25),
  PLZ INT(5),
  Geburtsdatum DATE,
  LeiterMId INTEGER  CHECK (LeiterMId>0),
  AbteilungsNr INTEGER CHECK ( AbteilungsNr>0),
  CONSTRAINT mitarbeiter_pk  PRIMARY KEY(MId),
  CONSTRAINT leiter_fk  FOREIGN KEY(LeiterMId) REFERENCES Mitarbeiter(MId),
  CONSTRAINT mitarbeiter_fk FOREIGN KEY (AbteilungsNr) REFERENCES Kochschule(AbteilungsNr)
);
CREATE TABLE Manager(
  SVNummer INT(20),
  EMail VARCHAR(90),
  Telefonummer VARCHAR(20) UNIQUE,
  MId INTEGER  UNIQUE NOT NULL,
  CONSTRAINT manager_pk PRIMARY KEY(SVNummer),
  CONSTRAINT manager_fk FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE
);
CREATE TABLE Koch(
  KochID INTEGER AUTO_INCREMENT,
  Rang CHAR(25),
  Ausbildung VARCHAR(40),
  MId INTEGER UNIQUE NOT NULL,
  CONSTRAINT koch_pk PRIMARY KEY(KochID),
  CONSTRAINT koch_fk FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE
);
CREATE TABLE Kochkurse(
  KursNr INTEGER AUTO_INCREMENT PRIMARY KEY,
  Preis  DECIMAL(5,2) DEFAULT 120,
  Thema VARCHAR(80),
  SVNummer INT(20)  NOT NULL ,
  CONSTRAINT kochkurse_fk FOREIGN KEY(SVNummer) REFERENCES Manager(SVNummer) ON DELETE CASCADE
);
CREATE TABLE Kursteilnehmer(
  KursteilnehmerNr INTEGER AUTO_INCREMENT,
  Vorname CHAR(30),
  Nachname CHAR(30),
  EMail VARCHAR(40),
  TelefonNr VARCHAR(14) UNIQUE,
  AbteilungsNr INTEGER NOT NULL,
  KursNr INTEGER NOT NULL,
  CONSTRAINT kursteilnehmer_pk PRIMARY KEY (KursteilnehmerNr),
  CONSTRAINT kursteilnehmer_a_fk FOREIGN KEY (AbteilungsNr) REFERENCES  Kochschule (AbteilungsNr) ON DELETE CASCADE,
  CONSTRAINT kursteilnehmnr_kn_fk FOREIGN KEY (KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE
);
CREATE TABLE Zeit(
  ZeitBlock  VARCHAR(14),
  Datum DATE,
  CONSTRAINT zb PRIMARY KEY(ZeitBlock,Datum)
);
CREATE TABLE Findet_statt(
  ZeitBlock VARCHAR(14),
  Datum DATE,
  KursNr INTEGER,
  Nummer DOUBLE PRECISION,
  AbteilungsNr INTEGER,
  CONSTRAINT fs_zeit_fk FOREIGN KEY(ZeitBlock,Datum)  REFERENCES Zeit(ZeitBlock,Datum) ON DELETE CASCADE,
  CONSTRAINT fs_kurs_fk FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  CONSTRAINT fs_kueche_fk FOREIGN KEY(AbteilungsNr,Nummer) REFERENCES Kueche(AbteilungsNr,Nummer) ON DELETE CASCADE,
  PRIMARY KEY(ZeitBlock,Datum,KursNr)
);
CREATE TABLE Fuehrt(
  KochID INTEGER,
  KursNr INTEGER,
  CONSTRAINT fuehrt_koch_fk FOREIGN KEY(KochID) REFERENCES Koch(KochID) ON DELETE CASCADE,
  CONSTRAINT fuehrt_kurs_fk FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  PRIMARY KEY(KochID,KursNr)
); */