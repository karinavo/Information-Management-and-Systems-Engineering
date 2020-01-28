import com.mchange.v2.c3p0.ComboPooledDataSource;

import javax.sql.DataSource;
import java.beans.PropertyVetoException;
import java.sql.*;
import java.time.LocalDate;
import java.time.temporal.ChronoUnit;
import java.util.*;
import java.util.concurrent.ThreadLocalRandom;

import com.mongodb.*;
import com.mongodb.client.MongoClients;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import static com.mongodb.client.model.Filters.*;
import org.bson.Document;

public class DataMigration {

    private static ComboPooledDataSource cpds = new ComboPooledDataSource();

    /// JDBC driver name and database URL
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    static final String DB_URL = "jdbc:mysql://localhost:3306/imse_db";

    //  Database credentials
    static final String USER = "root";
    static final String PASS = "rootpsw";
    private static void createPool()
    {
        try
        {
            cpds = new ComboPooledDataSource();
            cpds.setDriverClass("com.mysql.jdbc.Driver");
            cpds.setJdbcUrl("jdbc:mysql://localhost:3306/imse_db");
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
    private static boolean checkAllTablesExist(Connection conn) throws SQLException {
        //Check if all tables were created
        ResultSet rs0;
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
            return true;
        }else return false;

    }

    private static boolean checkKochschuleDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kochschule");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Kochschule: " + count);
            if(count==1){
                flag = true;
            }
        }
        rs1.close();
        return flag;
    }
    private static boolean checkKuecheDatenExist (Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kueche");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Kueche: " + count);
            if(count==109){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkMitarbeiterDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Mitarbeiter");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Mitarbeiter: " + count);
            if(count==200){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkManagerDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Manager");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Manager: " + count);
            if(count==49){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkKochDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Koch");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Koch: " + count);
            if(count==151){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkKochkurseDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kochkurse");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Kochkurse: " + count);
            if(count==3500){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkKursteilnehmerDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Kursteilnehmer");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Kursteilnehmer: " + count);
            if(count==3030){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkZeitDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Zeit");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Zeit: " + count);
            if(count>400){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkFindetStattDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Findet_statt");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Findet_statt: " + count);
            if(count>50){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    private static boolean checkFuehrtDatenExist(Connection conn) throws SQLException {
        // check number of datasets in Kochschule table
        Statement currentStatement = conn.createStatement();
        ResultSet rs1 = currentStatement.executeQuery("SELECT COUNT(*) FROM Fuehrt");
        boolean flag=false;
        if (rs1.next()) {
            int count = rs1.getInt(1);
            System.out.println("Number of datasets Fuehrt: " + count);
            if(count==349){
                flag = true;
            }
        }
        rs1.close();

        return flag;
    }
    public static void main(String[] args) {

        //START MONGODATABASE



        MongoClient mongoClient = null;
        MongoCredential mongoCredential = MongoCredential.createScramSha1Credential("admin", "admin",
                "adminpsw".toCharArray());
        mongoClient = new MongoClient(new ServerAddress("localhost", 27017), Arrays.asList(mongoCredential));

        // END
    try {
            // Create connection pool
            createPool();

            //Open a connection
            System.out.println("Connecting to a mariadb database...");

            Connection conn = getConnection();

            System.out.println("Connected mariadb database successfully...");
           boolean tables_exist = false;
            while(true){
                tables_exist = checkAllTablesExist(conn);
                if(tables_exist==false){
                    tables_exist = checkAllTablesExist(conn);
                }else{
                    break;
                }
            }
            while(true){
                if(checkFindetStattDatenExist(conn)==true&&checkFuehrtDatenExist(conn)==true&&checkKochDatenExist(conn)==true&&checkKochkurseDatenExist(conn)==true
                        &&checkKochschuleDatenExist(conn)==true&&checkZeitDatenExist(conn)==true&&checkKuecheDatenExist(conn)==true&&checkManagerDatenExist(conn)==true
                        &&checkMitarbeiterDatenExist(conn)==true&&checkKursteilnehmerDatenExist(conn)==true){
                    break;
                }
            }
            MongoDatabase mongoDatabase = mongoClient.getDatabase("imse_mongodb");
            if(mongoDatabase.getCollection("kochschuleCollection").countDocuments()==1&&
                mongoDatabase.getCollection("kuecheCollection").countDocuments()==109
                &&mongoDatabase.getCollection("mitarbeiterCollection").countDocuments()==200
                &&mongoDatabase.getCollection("kochCollection").countDocuments()==151
                    &&mongoDatabase.getCollection("managerCollection").countDocuments()==49
            &&mongoDatabase.getCollection("kochkurseCollection").countDocuments()==3500
            &&mongoDatabase.getCollection("kursteilnehmerCollection").countDocuments()==3030
                    &&mongoDatabase.getCollection("zeitCollection").countDocuments()>600){
                System.out.println("Databank is already migrated");
                System.exit(0);
            }
            //1. Kochschule
            KochschuleMigration kochschuleMigration = new KochschuleMigration(conn,mongoClient);
            kochschuleMigration.migrate();
            //2.Kueche
            KuecheMigrator kuecheMigrator = new KuecheMigrator(conn,mongoClient);
            kuecheMigrator.migrate();
            //3.Mitarbeiter
            MitarbeiterMigrator mitarbeiterMigrator = new MitarbeiterMigrator(conn,mongoClient);
            mitarbeiterMigrator.migrate();
            //4.Koch
            KochMigration kochMigration = new KochMigration(conn,mongoClient);
            kochMigration.migrate();
            //5.Manager
            ManagerMigrator managerMigrator = new ManagerMigrator(conn,mongoClient);
            managerMigrator.migrate();
            //6.Kochkurse
            KochkursMigrator kochkursMigrator = new KochkursMigrator(conn,mongoClient);
            kochkursMigrator.migrate();
            //7.Kursteilnehmer
            KursteilnehmerMigrator kursteilnehmerMigrator = new KursteilnehmerMigrator(conn,mongoClient);
            kursteilnehmerMigrator.migrate();
            //8.Zeit
            ZeitMigrator zeitMigrator = new ZeitMigrator(conn,mongoClient);
            zeitMigrator.migrate();
            //9.Findet_statt
            FindetStattMigrator findetStattMigrator = new FindetStattMigrator(conn,mongoClient);
            findetStattMigrator.migrate();
            //10.Fuehrt
            FuehrtMigration fuehrtMigration = new FuehrtMigration(conn,mongoClient);
            fuehrtMigration.migrate();
       }catch(SQLException e){
            System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
        } catch(Exception e){
            e.printStackTrace();
        }finally {
            mongoClient.close();
    }

    }
    }

