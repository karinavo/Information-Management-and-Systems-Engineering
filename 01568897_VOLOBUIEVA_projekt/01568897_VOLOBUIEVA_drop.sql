/*DROP TABLES*/
drop table FUEHRT CASCADE CONSTRAINTS;
drop table FINDET_STATT CASCADE CONSTRAINTS;
drop table ZEIT CASCADE CONSTRAINTS;
drop table KURSTEILNEHMER CASCADE CONSTRAINTS;
drop table KOCHKURSE CASCADE CONSTRAINTS;
drop table KOCH CASCADE CONSTRAINTS;
drop table MANAGER CASCADE CONSTRAINTS;
drop table MITARBEITER CASCADE CONSTRAINTS;
drop table KUECHE CASCADE CONSTRAINTS;
drop table KOCHSCHULE CASCADE CONSTRAINTS;
/**DROP SEQ*/
drop sequence kochschule_seq;
drop sequence koch_seq;
drop sequence seq_mid;
drop sequence kochkurse_seq;
drop sequence kunde_seq;
/*DROP VIEWS*/
drop view ANZAHL_MITAEBEITER;
drop view avg_gehalt;
drop view ANZAHL_KOCHKURSE;

