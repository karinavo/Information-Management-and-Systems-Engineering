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

public class KochMigration extends AMigration {
    public KochMigration(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Koch migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> mitarbeiter_collection = mongoDatabase.getCollection("mitarbeiterCollection");
        MongoCollection<Document> koch_collection = mongoDatabase.getCollection("kochCollection");

        ResultSet koch_mysql = current_statement.executeQuery("SELECT * FROM Koch");
        while (koch_mysql.next()) {
            int kochId = koch_mysql.getInt(1);
            String rang = koch_mysql.getString(2);
            String ausbildung  = koch_mysql.getString(3);
            int mID = koch_mysql.getInt(4);
            //find document mitarbeoiter
            Document mitrDoc = mitarbeiter_collection.find(eq("MId", mID)).first();
            // Add koch in document
            Document mitarbeiterDocument = new Document().append("KochID", kochId)
                    .append("Rang", rang)
                    .append("Ausbildung",ausbildung)
                    .append("MId",mitrDoc.get("_id", ObjectId.class));
            // Add koch in collection
            koch_collection.insertOne(mitarbeiterDocument);


        }
    }
}

