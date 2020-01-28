import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import org.bson.Document;

public class KochschuleMigration extends AMigration {
    public KochschuleMigration(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Kochschule migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("kochschuleCollection");

        ResultSet kochschule_mysql = current_statement.executeQuery("SELECT * FROM Kochschule");
        //KOCHSCHULE
        while (kochschule_mysql.next()) {
            int abteilungsNr = kochschule_mysql.getInt(1);
            String name = kochschule_mysql.getString(2);
            String ort = kochschule_mysql.getString(3);
            String PLZ = kochschule_mysql.getString(4);
            String strasse =kochschule_mysql.getString(5);
            // create document
            Document kochschuleDocument = new Document().append("AbteilungsNr", abteilungsNr).append("Name",name).append("Ort",ort).append("PLZ",PLZ).append("Strasse",strasse);
            // Add kochschule in collection
            kochschule_collection.insertOne(kochschuleDocument);

        }


    }
}
