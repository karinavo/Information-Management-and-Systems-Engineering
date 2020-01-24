import static com.mongodb.client.model.Filters.eq;

import com.mongodb.BasicDBObject;
import com.mongodb.DBCursor;
import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import com.mongodb.client.MongoDatabase;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Set;
import org.bson.Document;
import java.sql.SQLException;

public class KochschuleMigration extends AMigration {
    public KochschuleMigration(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Kochschule migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("kochschulen");

        ResultSet kochschule_mysql = current_statement.executeQuery("SELECT * FROM Kochschule");

        // Move cursor forward
        while (kochschule_mysql.next()) {

            int abteilungsNr = kochschule_mysql.getInt(1);
            String name = kochschule_mysql.getString(2);
            String ort = kochschule_mysql.getString(3);
            String PLZ = kochschule_mysql.getString(4);
            String strasse =kochschule_mysql.getString(5);
            // Add kochschule in document
            Document kochschuleDocument = new Document().append("AbteilungsNr", abteilungsNr).append("Name",name).append("Ort",ort).append("PLZ",PLZ).append("Strasse",strasse);
            // Add kochschule in collection
            kochschule_collection.insertOne(kochschuleDocument);


        }
    }
}
