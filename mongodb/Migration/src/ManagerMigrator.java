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


public class ManagerMigrator extends AMigration {
    public ManagerMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Manager migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> mitarbeiter_collection = mongoDatabase.getCollection("mitarbeiterCollection");
        MongoCollection<Document> manager_collection = mongoDatabase.getCollection("managerCollection");

        ResultSet manager_mysql = current_statement.executeQuery("SELECT * FROM Manager");
        while (manager_mysql.next()) {
            String svNummer = manager_mysql.getString(1);
            String eMail  = manager_mysql.getString(2);
            String tel = manager_mysql.getString(3);
            int mID = manager_mysql.getInt(4);
            //find document mitarbeoiter
            Document mitrDoc = mitarbeiter_collection.find(eq("MId", mID)).first();
            // Add koch in document
            Document mitarbeiterDocument = new Document().append("SVNummer", svNummer)
                    .append("EMail", eMail)
                    .append("Telefonummer",tel)
                    .append("MId",mitrDoc.get("_id", ObjectId.class));
            // Add koch in collection
            manager_collection.insertOne(mitarbeiterDocument);


        }
    }
}
