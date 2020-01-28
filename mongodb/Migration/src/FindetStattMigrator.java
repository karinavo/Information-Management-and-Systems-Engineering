import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Updates;
import org.bson.Document;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import static com.mongodb.client.model.Filters.and;
import static com.mongodb.client.model.Filters.eq;


public class FindetStattMigrator  extends AMigration {
    public FindetStattMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }
    @Override
    public void migrate() throws SQLException {
        System.out.println("Findet_statt migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document> zeit_collection = mongoDatabase.getCollection("zeitCollection");
        MongoCollection<Document> kochkurse_collection = mongoDatabase.getCollection("kochkurseCollection");
        MongoCollection<Document> kueche_collection = mongoDatabase.getCollection("kuecheCollection");


        ////
        FindIterable<Document> fi1 = kochkurse_collection.find();
        MongoCursor<Document> mongoCursorKurs = fi1.iterator();

        // Update Kochkurs

        try{

            while(mongoCursorKurs.hasNext()){
                Document current_doc = mongoCursorKurs.next();
                List<Document> zeitList = new ArrayList<Document>();
                ResultSet kurs_mysql = current_statement.executeQuery("SELECT * FROM Findet_statt WHERE KursNr = " + current_doc.getInteger("KursNr"));

                while(kurs_mysql.next()){
                    Document zeitDoc = zeit_collection.find(and(eq("ZeitBlock",kurs_mysql.getString(1)),eq("Datum",kurs_mysql.getString(2)))).first();
                    zeitList.add(zeitDoc);
                }
                kochkurse_collection.updateOne(current_doc, Updates.pushEach("Zeit", zeitList));
            }
        }finally {
            mongoCursorKurs.close();
        }

        // Update Kueche
        FindIterable<Document> fi2 = kueche_collection.find();
        MongoCursor<Document> mongoCursorKueche = fi2.iterator();
        try{

            while(mongoCursorKueche.hasNext()){
                Document current_doc = mongoCursorKueche.next();
                List<Document> zeitList = new ArrayList<Document>();
                ResultSet kueche_mysql = current_statement.executeQuery("SELECT * FROM Findet_statt WHERE Nummer = "  + current_doc.getInteger("Nummer"));
               while(kueche_mysql.next()) {

                   Document zeitDoc = zeit_collection.find(and(eq("ZeitBlock", kueche_mysql.getString(1)), eq("Datum", kueche_mysql.getString(2)))).first();
                   zeitList.add(zeitDoc);
               }
               kueche_collection.updateOne(current_doc, Updates.pushEach("Zeit", zeitList));
            }
        }finally {

            mongoCursorKueche.close();
        }
    }
}