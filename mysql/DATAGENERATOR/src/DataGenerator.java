import com.mchange.v2.c3p0.ComboPooledDataSource;

import javax.sql.DataSource;
import java.beans.PropertyVetoException;
import java.sql.*;
import java.time.LocalDate;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.GregorianCalendar;
import java.util.Scanner;
import java.util.concurrent.ThreadLocalRandom;

public class DataGenerator {

    private static ComboPooledDataSource cpds = new ComboPooledDataSource();

    private static void createPool()
    {
        try
        {
            cpds = new ComboPooledDataSource();
            cpds.setDriverClass("com.mysql.jdbc.Driver");
            cpds.setJdbcUrl("jdbc:mysql://mariadb:3306/imse_db");
            cpds.setUser("root");
            cpds.setPassword("rootpsw");
            cpds.setMinPoolSize(100);
            cpds.setMaxPoolSize(1000);
            //cpds.setAcquireIncrement(5);
            cpds.setAcquireRetryAttempts(100);
            //cpds.setConnectionCustomizerClassName();
            //cpds.setAcquireRetryDelay();
            //cpds.setBreakAfterAcquireFailure();
        }
        catch (PropertyVetoException ex)
        {
            System.err.println(ex.getMessage());
        }

    }

    private static Connection getConnection() throws SQLException {

        return cpds.getConnection();
    }


    //random year
    private static int randBetween(int start, int end) {
        return start + (int)Math.round(Math.random() * (end - start));
    }
    private static LocalDate createRandomDate(int startYear, int endYear) {
        int day = randBetween(1, 28);
        int month = randBetween(1, 12);
        int year = randBetween(startYear, endYear);
        return LocalDate.of(year, month, day);
    }
    public static void main(String[] args) {
        try {
            // Create connection pool
            createPool();

            //Open a connection
            System.out.println("Connecting to a selected database...");

            Connection conn = getConnection();

            System.out.println("Connected database successfully...");
            // Delimiter
            String delimiter = ";";
            //Check if all tables were created
            Statement currentStatement = conn.createStatement();
            ResultSet rs0 = null;
            DatabaseMetaData meta = (DatabaseMetaData) conn.getMetaData();
            rs0 = meta.getTables(null, null, null, new String[] {
                    "TABLE"
            });
            int tables_counter = 0;
            System.out.println("All table names are in test database:");
            while (rs0.next()) {
                String tblName = rs0.getString("TABLE_NAME");
                System.out.println(tblName);
                tables_counter++;
            }


            System.out.println(tables_counter + " Tables in database ");
            if (tables_counter == 10) {
                rs0.close();
                System.out.println("Number of tables in database: " + tables_counter);

                conn.close();
                System.exit(0);
            } else {
                rs0.close();
                // Create scanner
                Scanner scanner;
                scanner = new Scanner(DataGenerator.class.getResourceAsStream("create.sql")).useDelimiter(delimiter);


                // Loop through the SQL file statements
                currentStatement = null;
                while (scanner.hasNext()) {

                    // Get statement
                    String rawStatement = scanner.next() + delimiter;
                    try {
                        // Execute statement
                        currentStatement = conn.createStatement();
                        currentStatement.execute(rawStatement);
                    } catch (SQLException e) {
                        e.printStackTrace();
                    } finally {
                        // Release resources
                        if (currentStatement != null) {
                            try {
                                currentStatement.close();
                            } catch (SQLException e) {
                                e.printStackTrace();
                            }
                        }
                        currentStatement = null;
                    }

                }
                scanner.close();
                System.out.println("All tables were successfully created!");
                ////        INSERT DATA INTO TABLES
                currentStatement = conn.createStatement();

                //----------------------------------------------------------------------------------------------------------------------------------------------------------
                //INSERT Kochschule
                try {
                    String insertSql = "INSERT INTO Kochschule(Name,Ort,PLZ,Strasse) VALUES('Gusto','Wien',1020,'Taborstrasse 1-3')";
                    currentStatement.execute(insertSql);
                } catch (Exception e) {
                    System.err.println("Fehler beim Einfuegen des Datensatzes Kochschule: " + e.getMessage());
                }
                // check number of datasets in Kochschule table
                ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kochschule");
                if (rs1.next()) {
                    int count = rs1.getInt(1);
                    System.out.println("Number of datasets Kochschule: " + count);
                }
                //----------------------------------------------------------------------------------------------------------------------------------------------------------
                String[] ausstattung = {"5x Backoefen,3x Herde, 2x Kuehlschraenke und ein Geschirrspueler", "4x Backoefen,2x Herde, 2x Kuehlschraenke und ein Geschirrspueler",
                        "2x Backoefen,2x Herde, 2x Kuehlschraenke und ein Geschirrspueler"};
                //INSERT Kueche
                for (int i = 1; i < 110; i++) {

                    try {
                        String insertSql = "INSERT INTO Kueche(AbteilungsNr,Nummer,Fassungsvermoegen,Ausstattung) VALUES (1," + i + ",15,'" + ausstattung[(int) (Math.random() * 3)] + "')";
                        currentStatement.execute(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Kueche: " + e.getMessage());
                    }
                }
                // check number of datasets in Kueche table
                ResultSet rs2 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kueche");
                if (rs2.next()) {
                    int count = rs2.getInt(1);
                    System.out.println("Number of datasets Kueche: " + count);
                }
                //----------------------------------------------------------------------------------------------------------------------------------------------------------
                String[] mnachname = {"Mueller", "Schmidt", "Schneider", "Fischer", "Weber", "Meyer", "Wagner", "Becker", "Schulz", "Hoffmann", "Schaefer", "Koch",
                        "Bauer", "Richter", "Klein", "Wolf", "Schraeder", "Neumann", "Schwarz", "Zimmermann", "Braun", "Hartmann", "Lange", "Schmitt",
                        "Werner", "Schmitz", "Krause", "Vogel", "Friedrich", "Keller", "Guenther", "Frank", "Chen", "Yang", "Huang ", "Zhak", "Berger", "Winkler", "Roth", "Baumann", "Albrecht",
                        "Schuster", "Horn", "Busch", "Bergmann", "Thomas", "Voigt", "Sauer", "Arnold", "Wolff", "Pfeiffer", "Oliver", "Colombo", "Wang", " Gao"};

                String[] mvorname = {"James", "Olivia", "Amelia", "Emily", "Isla", "Ava", "Isabella", "Lily", "Jessica", "Ella", "Mia", "Sophia", "Charlotte", "Poppy", "Grace", "Evie",
                        "Alice", "Scarlett", "Freya", "Florence", "Harry", "George", "Jack", "Jacob", "Noah", "Charlie", "Muhammad", "Thomas ", "Oscar", "William",
                        "James", "Leo", "Alfie", "Henry", "Joshua", "Freddie", "Archie", "Ethan", "Isaac", "Alexander", "Joseph", "Edward", "Samuel", "Max", "Logan"};


                String[] madresse = {"Taborstrasse", "Adambergergasse", "Afrikanergasse", "Alliiertenstrasse", "Am Tabor", "Blumauergasse", "Czerningasse", "Dammhaufengasse",
                        "Dritter-Mann-Weg", "Haasgasse", "Haidgasse", "Harkortstrasse", "Holubstrasse", "Innstrasse", "Josefinengasse", "Jungstrasse", "Kaiserallee",
                        "Konradgasse", "Krummbaumgasse", "Lancplatz", "Leichtweg", "Leopoldsgasse", "Lilienbrunngasse", "Machstrasse", "Messeplatz", "Nepomukgasse"};
                String[] mmonat = {"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"};
                String[] mtagen1 = {"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13",
                        "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"};
                String[] mtagen2 = Arrays.copyOf(mtagen1, 30);
                String[] mtagen3 = Arrays.copyOf(mtagen1, 28);
                Double[] mgehalt = {800.00, 1000.00, 1100.50, 1200.60, 1500.00, 1600.86, 1700.45, 2100.00, 2350.50, 3000.00};
                //Rang fuer Koch
                String[] rang = {"Chef de Partie", "Kuechenchef", "Souschef", "Demi Chef de Partie", "Commis de Cuisine", "Beikoch", "Apprentis", "Casserolier", "Stagiaires"};
                String[] ausbildung = {"International Culinary Center", "French Culinary Institute", "Cordon bleu", "Culinary Institute of America", "New England Culinary Institute",
                        "The Restaurant School at Walnut Hill College"};
                //INSERT Mitarbeiter
                for (int i = 0; i < 200; i++) {
                    String monat = (mmonat[(int) ((Math.random() * 12))]);
                    String tag;
                    if (monat == "02") {
                        monat = "02";
                        tag = mtagen3[(int) (Math.random() * 28)];
                    } else if (monat == "04" || monat == "06" || monat == "09" || monat == "11") {
                        tag = mtagen2[(int) (Math.random() * 30)];
                    } else tag = mtagen1[(int) (Math.random() * 31)];
                    //year
                    GregorianCalendar gc = new GregorianCalendar();
                    int jahr = randBetween(1950, 2000);
                    gc.set(gc.YEAR, jahr);
                    //sep data
                    String nachname1 = mnachname[(int) (Math.random() * 55)];
                    String vorname1 = mvorname[(int) (Math.random() * 45)];
                    String gebdat = gc.get(gc.YEAR) + monat + tag;

                    try {
                        String insertSql = "INSERT INTO Mitarbeiter(Nachname, Vorname,Gehalt,Strasse, Ort, PLZ, Geburtsdatum,LeiterMId,AbteilungsNr)  VALUES ('"
                                + nachname1 + "','" +
                                vorname1 + "'," +
                                mgehalt[(int) (Math.random() * 10)] + ",'" +
                                madresse[(int) (Math.random() * 26)] + "','Wien',1020,STR_TO_DATE('" +
                                gc.get(gc.YEAR) + '-' + monat + '-' + tag + "','%Y-%m-%d'),Null," + 1 + ")";
                        currentStatement.execute(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Mitarbeiter: " + e.getMessage());
                    }
                }
                // check number of datasets in Mitarbeiter table
                ResultSet rs3 = currentStatement.executeQuery("SELECT COUNT(*) FROM Mitarbeiter");
                if (rs3.next()) {
                    int count = rs3.getInt(1);
                    System.out.println("Number of datasets Mitarbeiter: " + count);
                }
                //------------------------------------------------------------------------------------------------------

                // INSERT Koch
                for (int k = 50; k < 201; k++) {
                    try {
                        String insertSql = "INSERT INTO Koch(Rang, Ausbildung, MId)  VALUES ('"
                                + rang[(int) (Math.random() * 9)] + "','" +
                                ausbildung[(int) (Math.random() * 5)] + "'," + k + ")";
                        currentStatement.execute(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Koch: " + e.getMessage());
                    }
                }
                // check number of datasets in Koch table
                ResultSet rs4 = currentStatement.executeQuery("SELECT COUNT(*) FROM Koch");
                if (rs4.next()) {
                    int count = rs4.getInt(1);
                    System.out.println("Number of datasets Koch: " + count);
                }
                //-----------------------------------------------------------------------------------------------------
                //INSERT Manager
                ResultSet rnachname = null;
                for (int j = 1; j < 50; j++) {
                    try {
                        String sets = "SELECT Nachname,Vorname,Geburtsdatum FROM Mitarbeiter WHERE MId=" + j;
                        currentStatement = conn.createStatement();
                        rnachname = currentStatement.executeQuery(sets);
                        String insertManager;
                        String nname;
                        if (rnachname.next()) {
                            nname = rnachname.getString("Nachname");
                            String vname = rnachname.getString("Vorname");
                            String geb1 = rnachname.getString("Geburtsdatum");
                            String geb2 = geb1.replace("-", "");
                            String geb3 = geb2.replace("00:00:00.0", "");

                            String email1 = nname + vname + j + "@gmail.com";

                            insertManager = "INSERT INTO Manager(SVNummer, EMail, Telefonummer, MId) VALUES('" +
                                    j + geb3 + "','" +
                                    email1 + "','+43366075940" + j + "'," + j + ")";
                            currentStatement.executeUpdate(insertManager);
                        }
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Manager: " + e.getMessage());
                    } finally {
                        // Release resources
                        if (currentStatement != null) {
                            rnachname.close();
                        }
                    }
                }
                // check number of datasets in Manager table
                ResultSet rs5 = currentStatement.executeQuery("SELECT COUNT(*) FROM Manager");
                if (rs5.next()) {
                    int count = rs5.getInt(1);
                    System.out.println("Number of datasets Manager: " + count);
                }
                // Insert ChefId
                try {
                    String insertSql = "UPDATE Mitarbeiter SET LeiterMId = (SELECT MId FROM Mitarbeiter WHERE MId =" + 1 + ")";
                    currentStatement.execute(insertSql);
                } catch (Exception e) {
                    System.err.println("Fehler beim Einfuegen des Datensatzes CHEF: " + e.getMessage());
                }
                //-------------------------------------------------------------------------------------------------------------


                //Themen
                String[] themen = {"Alles WOK!", "Festlicher Osterbrunch", "Koenigliche Spargelstangen", "Give me Five", "Gerichte und Geschichten aus der Tuerkei", "Vegan und Genuss!",
                        "Zurueck zu den Wurzeln", "Weihnachtsgeschenke aus der Kueche", "Ganz schoen Wild"};
                //Preisen
                Double[] preis = {69.50, 200.00, 156.00, 79.00, 49.00, 59.00, 169.00, 250.00, 99.00, 300.00};
                ResultSet rsv = null;
                //Insert Kochkurse

                for (int i = 0; i < 3500; i++) {
                    try {

                        String sets = "SELECT SVNummer FROM Manager";
                        rsv = currentStatement.executeQuery(sets);
                        ArrayList<String> svns = new ArrayList<String>();
                        String sv;

                        while (rsv.next()) {
                            sv = rsv.getString("SVNummer");

                            svns.add(sv);
                        }
                        int size = svns.size();
                        int random = (int) (Math.random() * size);
                        String insertSql = "INSERT INTO Kochkurse(Preis, Thema, SVNummer)  VALUES (" + preis[(int) (Math.random() * 10)] + ",'" +
                                themen[(int) (Math.random() * 9)] + "','" +
                                svns.get(random) + "')";
                        currentStatement.executeUpdate(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Kochkurse: " + e.getMessage());
                    } finally {
                        if (currentStatement != null) rsv.close();
                    }

                }
                //check number of datasets in Kochkurse table
                ResultSet rs6 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kochkurse");
                if (rs6.next()) {
                    int count = rs6.getInt(1);
                    System.out.println("Number of datasets Kochkurse: " + count);
                }
                //-------------------------------------------------------------------------------------------------------------------------------------
                //Names vor Kursteilnehmer
                String[] kvorname = {"Tiana", "Claretha", "Jenny", "Janina", "Prudence", "Scarlett", "Chanda", "Linwood", "Marg", "Dung", "Janeen", "Christia", "Reva",
                        "Debroah", "Augustina", "Marguerite", "Mariano", "Shari", "Chet", "Anne", "Eugenio", "Un", "Jules", "Li", "Alessandra",
                        "Darla", "Iva", "Justine", "Gilberto", "Clarice", "Giuseppe", "So", "Cuc", "Charla", "Fern", "Zachary", "Kandice", "Babara",
                        "Latoria", "Pansy", "Joann", "Kristel", "Giovanni", "Leona", "Christal", "Roscoe", "Brigid", "Gregoria", "Hipolito", "Jolene", "Dovie",
                        "Jestine", "Norma", "Lakisha", "Quintin", "Diedre",
                        "Mathilda", "Valeria", "Robyn", "Adella", "Teddy", "Benedict", "Pearl", "Rosalina", "Marin", "Melia",
                        "Gertie", "Sal", "Alexandra", "Carolynn", "Rena", "Hayley", "Tyron", "Phyllis", "Leif",
                        "Bettina", "Lowell", "Theda", "Delphine", "Patti", "Adena", "Verena", "Adrian", "Jacquelyn", "Yasuko", "Brittny", "Della",
                        "Cherryl", "Malisa", "Damien", "Don", "Stacey", "Fred", "Gertha", "Kermit", "Luanna", "Matha", "Yadira", "Wilmer", "Sarah"};
                String[] knachname = {"Ballard", "Lutz", "Frederick", "Lopez", "May", "Pugh", "Bonilla",
                        "Mckee", "Clements", "Maldonado", "Cantrell", "Prince", "Chaney", "Brooks", "Pennington", "Burns", "Khan",
                        "Mcgrath", "Bush", "Anthony", "Yang", "Kemp", "Hawkins", "Fleming", "Hobbs", "Diaz", "Deleon", "Porter", "Bruce",
                        "Hunt", "Cortez", "Espinoza", "Robles", "Walters", "Lang", "Booth", "Solomon",
                        "Johnston", "Rose", "Perez", "Vang", "Harding", "James", "Andrews", "Watts", "Harper", "Esparza",
                        "Mcknight", "Scott", "Grant", "Russell", "Gutierrez",
                        "Stephens", "Strong", "Hardy", "Fuller", "Hubbard", "Ellison", "Gardner", "Trevino", "Guzman",
                        "Moran", "Brennan", "Vaughn", "Clarke", "Delacruz", "Stuart", "Freeman", "Leon", "Reynolds", "Wade", "Parrish", "Whitney",
                        "Koch", "Gaines", "Cowan", "Estes", "Schneider", "Rojas", "Orr", "Mcintosh", "Sims",
                        "Flowers", "Whitaker", "Osborn", "Melendez", "Avery", "Hardin", "Mooney",
                        "Mueller", "Hodge", "Powell", "Colon", "Salinas", "Schwartz"};

                //INSERT Kursteilnehmer
                for (int i = 0; i < 3030; i++) {
                    try {

                        String vname = kvorname[(int) (Math.random() * 100)];
                        String nname = knachname[(int) (Math.random() * 95)];
                        String email = vname + nname + i + "@yahoo.com";
                        String insertSql = "INSERT INTO Kursteilnehmer(Vorname, Nachname, EMail, TelefonNr, AbteilungsNr, KursNr) VALUES('" +
                                vname + "','" +
                                nname + "','" +
                                email + i + "'," + "'+43660835" + i + "',"
                                + 1 + "," +
                                (int) (Math.random() * 3499 + 1) + ")";
                        currentStatement.executeUpdate(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Kursteilnehmer: " + e.getMessage());
                    }

                }
                // check number of datasets in Kursteilnehmer table
                ResultSet rs7 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kursteilnehmer");
                if (rs7.next()) {
                    int count = rs7.getInt(1);
                    System.out.println("Number of datasets Kursteilnehmer: " + count);
                }

                //---------------------------------------------------------------------------------------------------------------------------------------
                ///ZeitBlock
                String[] zeitblock = {"1. 10:00-14:00", "2. 14:15-18:15", "3. 18:30-22:30"};
                //INSERT Zeit

                for (int i = 0; i < 1000; i++) {
                    try {

                        LocalDate randomDate = createRandomDate(2020, 2021);
                        LocalDate dt = randomDate;
                        String block = zeitblock[(int) (Math.random() * 3)];

                        String insertSql = "INSERT INTO Zeit SELECT '" + block + "', STR_TO_DATE('"
                                + dt + "','%Y-%m-%d') FROM dual WHERE NOT EXISTS (SELECT * FROM Zeit WHERE Zeit.ZeitBlock = '" +
                                block + "' AND Datum=STR_TO_DATE('" + dt + "','%Y-%m-%d'))";

                        currentStatement.executeUpdate(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Zeit: " + e.getMessage());
                    }
                }
                // check number of datasets in Zeit table
                ResultSet rs8 = currentStatement.executeQuery("SELECT COUNT(*) FROM Zeit");
                if (rs8.next()) {
                    int count = rs8.getInt(1);
                    System.out.println("Number of datasets Zeit: " + count);
                }
                //-------------------------------------------------------------------------------------------------------
                //Resultset
                ResultSet zrs = null;


                //Insert Findett_statt  1
                for (int i = 1; i < 300; i++) {

                    String zeit = "SELECT Datum FROM Zeit WHERE ZeitBlock= '1. 10:00-14:00'";
                    zrs = currentStatement.executeQuery(zeit);

                    String date_insert ="";
                    String dtm;
                    if (zrs.next()) {
                        dtm = zrs.getString("Datum");
                        String dtm1 = dtm.replace("00:00:00.0", "");
                        date_insert=dtm1;
                    }



                    int kueche_nummer = (int) (Math.random() * 108 + 1);

                    try {
                        String insertSql1 = "INSERT IGNORE INTO Findet_statt SELECT '1. 10:00-14:00', STR_TO_DATE('" +
                                date_insert + "','%Y-%m-%d')," +
                                (int) (i) + "," +
                                kueche_nummer + "," + 1 +
                                " FROM dual WHERE NOT EXISTS (SELECT * FROM Findet_statt WHERE ZeitBlock= '1. 10:00-14:00' AND Datum= STR_TO_DATE('" +
                                date_insert + "','%Y-%m-%d') AND KursNr=" + (int) (i) +
                                " AND Nummer=" +kueche_nummer + " AND AbteilungsNr=" + 1 + ")";

                        currentStatement.executeUpdate(insertSql1);

                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Findett_statt 1: " + e.getMessage());
                    } finally {
                        if (currentStatement != null) {
                            zrs.close();
                        }

                    }
                }
                ResultSet rs9 = currentStatement.executeQuery("SELECT COUNT(*) FROM Findet_statt");
                if (rs9.next()) {
                    int count = rs9.getInt(1);
                    System.out.println("Number of datasets Findet_statt after insertion zeitblock 1: " + count);
                }

                //Insert Findett_statt  2
                ResultSet zrs2 = null;


                for (int i = 1; i < 200; i++) {
                    String zeit = "SELECT Datum FROM Zeit WHERE ZeitBlock= '2. 14:15-18:15'";
                    zrs2 = currentStatement.executeQuery(zeit);

                    String date_insert ="";
                    String dtm;
                    if (zrs2.next()) {
                        dtm = zrs2.getString("Datum");
                        String dtm1 = dtm.replace("00:00:00.0", "");
                        date_insert=dtm1;
                    }


                    int kueche_nummer = (int) (Math.random() * 108 + 1);

                    try {

                        String insertSql = "INSERT IGNORE INTO Findet_statt SELECT '2. 14:15-18:15', STR_TO_DATE('" +
                                date_insert+ "','%Y-%m-%d')," +
                                (int) (i) + "," +
                                kueche_nummer + "," + 1 +
                                " FROM dual WHERE NOT EXISTS (SELECT * FROM Findet_statt WHERE ZeitBlock= '2. 14:15-18:15' AND Datum= STR_TO_DATE('" +
                                date_insert + "','%Y-%m-%d') AND KursNr=" + (int) (i) +
                                " AND Nummer=" + kueche_nummer + " AND AbteilungsNr=" + 1 + ")";

                        currentStatement.executeUpdate(insertSql);

                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes Findett_statt 2: " + e.getMessage());
                    } finally {
                        if (currentStatement != null) {
                            zrs2.close();
                        }

                    }
                }
                ResultSet rs10 = currentStatement.executeQuery("SELECT COUNT(*) FROM Findet_statt");
                if (rs10.next()) {
                    int count = rs10.getInt(1);
                    System.out.println("Number of datasets Findet_statt after insertion zeitblock 2: " + count);
                }
                //---------------------------------------------------------------------------------------------------------------------------------------
                //insert in fuehrt
                for (int i = 1; i < 350; i++) {
                    try {

                        String insertSql = "INSERT INTO Fuehrt SELECT " + ((int) (Math.random() * 150 + 1)) + "," + ((int) (i))
                                + " FROM dual WHERE NOT EXISTS (SELECT * FROM Fuehrt WHERE KochID = " +
                                (int) (Math.random() * 150 + 1) + " AND KursNr=" + i + ")";
                        currentStatement = conn.createStatement();
                        currentStatement.executeUpdate(insertSql);
                    } catch (Exception e) {
                        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
                    }
                }
                // check number of datasets in Fuehrt table
                ResultSet rs11 = currentStatement.executeQuery("SELECT COUNT(*) FROM Fuehrt");
                if (rs11.next()) {
                    int count = rs11.getInt(1);
                    System.out.println("Number of datasets Fuehrt: " + count);
                }
                // clean up connections
                rs1.close();
                rs2.close();
                rs3.close();
                rs4.close();
                rs5.close();
                rs6.close();
                rs7.close();
                rs8.close();
                rs9.close();
                rs10.close();
                rs11.close();
                currentStatement.close();
                conn.close();
                }
            }catch(SQLException e){
                System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
            } catch(Exception e){
                e.printStackTrace();
            }
    }
}
