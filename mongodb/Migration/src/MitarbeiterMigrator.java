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
import org.bson.types.ObjectId;

import java.sql.SQLException;

public class MitarbeiterMigrator extends AMigration {
    public MitarbeiterMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Mitarbeiter migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> mitarbeiter_collection = mongoDatabase.getCollection("mitarbeiterCollection");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("kochschuleCollection");

        ResultSet mitarbeiter_mysql = current_statement.executeQuery("SELECT * FROM Mitarbeiter");
        //KOCHSCHULE


        while (mitarbeiter_mysql.next()) {
            int mID = mitarbeiter_mysql.getInt(1);
            String nachname = mitarbeiter_mysql.getString(2);
            String vorname = mitarbeiter_mysql.getString(3);
            double gehalt = mitarbeiter_mysql.getDouble(4);
            String strasse = mitarbeiter_mysql.getString(5);
            String ort = mitarbeiter_mysql.getString(6);
            int plz = mitarbeiter_mysql.getInt(7);
            String gebDatum = mitarbeiter_mysql.getString(8);
            int leiterID = mitarbeiter_mysql.getInt(9);
            int abtNr = mitarbeiter_mysql.getInt(10);
            //find document to the kochschule
            Document kochschuleDoc = kochschule_collection.find(eq("AbteilungsNr", abtNr)).first();
            // Add mitarbeiter in document
            Document mitarbeiterDocument = new Document().append("MId", mID).append("Nachname",nachname)
                    .append("Vorname",vorname).append("Gehalt",gehalt).append("Strasse",strasse).append("Ort", ort)
                    .append("PLZ",plz).append("Geburtsdatum",gebDatum)
                    .append("LeiterMId", leiterID)
                    .append("AbteilungsNr",kochschuleDoc.get("_id", ObjectId.class));
            // Add mitarbeiter in collection
            mitarbeiter_collection.insertOne(mitarbeiterDocument);


        }
    }
}
