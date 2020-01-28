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

public class KuecheMigrator extends AMigration {
    public KuecheMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Kueche migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("kochschuleCollection");
        MongoCollection<Document> kueche_collection = mongoDatabase.getCollection("kuecheCollection");
        ResultSet kueche_mysql = current_statement.executeQuery("SELECT * FROM Kueche");


        while(kueche_mysql.next()){
            int nummber = kueche_mysql.getInt(2);
            int fassung = kueche_mysql.getInt(3);
            String ausstatung = kueche_mysql.getString(4);
            Document kochschuleDoc = kochschule_collection.find(eq("AbteilungsNr",kueche_mysql.getInt(1))).first();
            Document kuecheDocument = new Document().append("AbteilungsNr",kochschuleDoc.get("_id",ObjectId.class)).append("Nummer",nummber).append("Fassungsvermoegen",fassung).append("Ausstattung",ausstatung);

            kueche_collection.insertOne(kuecheDocument);
            }

    }
}
