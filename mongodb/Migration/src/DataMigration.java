import com.mchange.v2.c3p0.ComboPooledDataSource;

import javax.sql.DataSource;
import java.beans.PropertyVetoException;
import java.sql.*;
import java.time.LocalDate;
import java.time.temporal.ChronoUnit;
import java.util.*;
import java.util.concurrent.ThreadLocalRandom;
import com.mongodb.MongoClient;
import com.mongodb.MongoClientURI;
import com.mongodb.MongoCredential;
import com.mongodb.ServerAddress;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import static com.mongodb.client.model.Filters.*;
import org.bson.Document;

public class DataMigration {

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
                List<ServerAddress> seeds = new ArrayList<ServerAddress>();
                seeds.add( new ServerAddress( "localhost",27017));
                List<MongoCredential> credentials = new ArrayList<MongoCredential>();
                credentials.add(
                        MongoCredential.createMongoCRCredential(
                                "admin",
                                "imse_mongodb",
                                "adminpsw".toCharArray()
                        )
                );
                MongoClient mongoClient = new MongoClient( seeds, credentials );

                System.out.println("HERE");
                // Retrieving a collection
                MongoDatabase mongoDatabase = mongoClient.getDatabase("imse_mongodb");
                MongoCollection<Document> collection = mongoDatabase.getCollection("students");
/***
                Document doc = new Document("id", "4712")
                        .append("name", "Sylvia Musterfrau")
                        .append("regnr", "1600234")
                        .append("curriculum", new Document("name", "Informatics")
                                .append("type", "Bachelor")
                                .append("currnr", "521" ));
                collection.insertOne(doc);
                System.out.println("END");
***/
                // Count documents
                System.out.print(collection.count()); System.out.println(" Docs in collection");
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

