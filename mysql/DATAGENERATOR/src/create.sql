CREATE TABLE Kochschule (
  AbteilungsNr INTEGER AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(25),
  Ort VARCHAR(25),
  PLZ INT(5),
  Strasse VARCHAR(40)
);
CREATE TABLE Kueche(
  AbteilungsNr  INTEGER NOT NULL,
  Nummer  DOUBLE PRECISION,
  Fassungsvermoegen INT(2),
  Ausstattung VARCHAR(90),
  FOREIGN KEY (AbteilungsNr) REFERENCES Kochschule(AbteilungsNr),
  PRIMARY KEY(AbteilungsNr,Nummer)
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
  PRIMARY KEY(MId),
  FOREIGN KEY(LeiterMId) REFERENCES Mitarbeiter(MId),
  FOREIGN KEY (AbteilungsNr) REFERENCES Kochschule(AbteilungsNr)
);
CREATE TABLE Manager(
  SVNummer VARCHAR(90),
  EMail VARCHAR(90),
  Telefonummer VARCHAR(30) UNIQUE,
  MId INTEGER  UNIQUE NOT NULL,
  PRIMARY KEY(SVNummer),
  FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE
);
CREATE TABLE Koch(
  KochID INTEGER AUTO_INCREMENT,
  Rang CHAR(25),
  Ausbildung VARCHAR(40),
  MId INTEGER UNIQUE NOT NULL,
  PRIMARY KEY(KochID),
  FOREIGN KEY(MId) REFERENCES Mitarbeiter(MId) ON DELETE CASCADE
);
CREATE TABLE Kochkurse(
  KursNr INTEGER AUTO_INCREMENT PRIMARY KEY,
  Preis  DECIMAL(5,2) DEFAULT 120,
  Thema VARCHAR(80),
  SVNummer VARCHAR(90)  NOT NULL ,
  FOREIGN KEY(SVNummer) REFERENCES Manager(SVNummer) ON DELETE CASCADE
);
CREATE TABLE Kursteilnehmer(
  KursteilnehmerNr INTEGER AUTO_INCREMENT,
  Vorname CHAR(30),
  Nachname CHAR(30),
  EMail VARCHAR(40),
  TelefonNr VARCHAR(14) UNIQUE,
  AbteilungsNr INTEGER NOT NULL,
  KursNr INTEGER NOT NULL,
  PRIMARY KEY (KursteilnehmerNr),
  FOREIGN KEY (AbteilungsNr) REFERENCES  Kochschule (AbteilungsNr) ON DELETE CASCADE,
  FOREIGN KEY (KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE
);
CREATE TABLE Zeit(
  ZeitBlock  VARCHAR(14),
  Datum DATE,
  PRIMARY KEY(ZeitBlock,Datum)
);
CREATE TABLE Findet_statt(
  ZeitBlock VARCHAR(14),
  Datum DATE,
  KursNr INTEGER,
  Nummer DOUBLE PRECISION,
  AbteilungsNr INTEGER,
  FOREIGN KEY(ZeitBlock,Datum)  REFERENCES Zeit(ZeitBlock,Datum) ON DELETE CASCADE,
  FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  FOREIGN KEY(AbteilungsNr,Nummer) REFERENCES Kueche(AbteilungsNr,Nummer) ON DELETE CASCADE,
  PRIMARY KEY(ZeitBlock,Datum,KursNr)
);
CREATE TABLE Fuehrt(
  KochID INTEGER,
  KursNr INTEGER,
  FOREIGN KEY(KochID) REFERENCES Koch(KochID) ON DELETE CASCADE,
  FOREIGN KEY(KursNr) REFERENCES Kochkurse(KursNr) ON DELETE CASCADE,
  PRIMARY KEY(KochID,KursNr)
);
