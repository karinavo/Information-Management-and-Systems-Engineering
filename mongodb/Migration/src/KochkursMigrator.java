import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import org.bson.Document;
import org.bson.types.ObjectId;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import static com.mongodb.client.model.Filters.eq;

public class KochkursMigrator  extends AMigration {
    public KochkursMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }
    @Override
    public void migrate() throws SQLException {
        System.out.println("Kochkurse migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> kochkurse_collection = mongoDatabase.getCollection("kochkurseCollection");
        MongoCollection<Document> manager_collection = mongoDatabase.getCollection("managerCollection");

        ResultSet kochkurs_mysql = current_statement.executeQuery("SELECT * FROM Kochkurse");


        while (kochkurs_mysql.next()) {
            int kursNr = kochkurs_mysql.getInt(1);
            double preis = kochkurs_mysql.getDouble(2);
            String thema = kochkurs_mysql.getString(3);
            String svNr = kochkurs_mysql.getString(4);
            Document managerDoc = manager_collection.find(eq("SVNummer", svNr)).first();
            // create document
            Document kursDocument = new Document().append("KursNr", kursNr).append("Preis",preis)
                    .append("Thema",thema)
                    .append("SVNummer",managerDoc.get("_id", ObjectId.class));
            // Add kurs in collection
            kochkurse_collection.insertOne(kursDocument);


        }
    }
}
