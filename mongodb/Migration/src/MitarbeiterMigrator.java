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

public class MitarbeiterMigrator extends AMigration {
    public MitarbeiterMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Kochschule migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("mitarbeiter");

        ResultSet mitarbeiter_mysql = current_statement.executeQuery("SELECT * FROM Mitarbeiter");
        //KOCHSCHULE
        while (mitarbeiter_mysql.next()) {
            int abteilungsNr = mitarbeiter_mysql.getInt(1);
            String name = mitarbeiter_mysql.getString(2);
            String ort = mitarbeiter_mysql.getString(3);
            String PLZ = mitarbeiter_mysql.getString(4);
            String strasse =mitarbeiter_mysql.getString(5);
            // Add mitarbeiter in document
            Document mitarbeiterDocument = new Document().append("AbteilungsNr", abteilungsNr).append("Name",name).append("Ort",ort).append("PLZ",PLZ).append("Strasse",strasse);
            // Add mitarbeiter in collection
       //     kochschule_collection.insertOne(kochschuleDocument);


        }
    }
}
