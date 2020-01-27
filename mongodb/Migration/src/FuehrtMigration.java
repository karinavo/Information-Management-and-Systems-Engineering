import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Updates;
import org.bson.Document;
import org.bson.types.ObjectId;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import static com.mongodb.client.model.Filters.eq;


public class FuehrtMigration extends AMigration {
    public FuehrtMigration(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }


    /// Many to Many relationship
    @Override
    public void migrate() throws SQLException {
        System.out.println("Fuehrt migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> koch_collection = mongoDatabase.getCollection("kochCollection");
        MongoCollection<Document> kochkurseCollection = mongoDatabase.getCollection("kochkurseCollection");

        ResultSet fuehrt_mysql = current_statement.executeQuery("SELECT * FROM Fuehrt");
        /////////////////////// Update Koch collection
        FindIterable<Document> fi = koch_collection.find();
        System.out.println("Koch " + koch_collection.countDocuments());
        FindIterable<Document> kursit = kochkurseCollection.find();
        MongoCursor<Document> mongoCursorKoch = fi.iterator();
        MongoCursor<Document> mongoCursorKurs =kursit.iterator();

        try{

            while(mongoCursorKoch.hasNext()){
                Document current_doc = mongoCursorKoch.next();
                List<ObjectId> kursList = new ArrayList<ObjectId>();
                ResultSet kurs_mysql = current_statement.executeQuery("SELECT * FROM Fuehrt WHERE KochID = " + current_doc.getInteger("KochID"));

                while(kurs_mysql.next()){
                    Document kursDoc = kochkurseCollection.find(eq("KursNr",kurs_mysql.getInt(2))).first();
                    kursList.add(kursDoc.get("_id", ObjectId.class));
                }
                koch_collection.updateOne(current_doc, Updates.pushEach("Fuehrung", kursList));
            }
        }finally {
            mongoCursorKoch.close();
        }
        //////////////////////// Update Kochkurse collection
        try{

            while(mongoCursorKurs.hasNext()){
                Document current_doc = mongoCursorKurs.next();
                List<ObjectId> kochList = new ArrayList<ObjectId>();
                ResultSet koch_mysql = current_statement.executeQuery("SELECT * FROM Fuehrt WHERE KursNr = " + current_doc.getInteger("KursNr"));
                while(koch_mysql.next()){
                    Document kochDoc = koch_collection.find(eq("KochID",koch_mysql.getInt(1))).first();
                    kochList.add(kochDoc.get("_id", ObjectId.class));
                }
                kochkurseCollection.updateOne(current_doc, Updates.pushEach("Fuehrung", kochList));
            }
        }finally {
            mongoCursorKurs.close();
        }


    }
}