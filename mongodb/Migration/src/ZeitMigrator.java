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

public class ZeitMigrator  extends AMigration {
    public ZeitMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }
    @Override
    public void migrate() throws SQLException {
        System.out.println("Zeit migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> zeit_collection = mongoDatabase.getCollection("zeitCollection");

        ResultSet zeit_mysql = current_statement.executeQuery("SELECT * FROM Zeit");


        while (zeit_mysql.next()) {
            String zeitB = zeit_mysql.getString(1);
            String date = zeit_mysql.getString(2);

            Document zeitDocument = new Document().append("ZeitBlock", zeitB).append("Date",date);

            zeit_collection.insertOne(zeitDocument);


        }
    }
}