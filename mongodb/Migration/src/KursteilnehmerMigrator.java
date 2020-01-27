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


public class KursteilnehmerMigrator extends AMigration {
    public KursteilnehmerMigrator(Connection mariadb_conn, MongoClient mongoClient) {
        super(mariadb_conn, mongoClient);
    }

    @Override
    public void migrate() throws SQLException {
        System.out.println("Kursteilnehmer migrating");
        Statement current_statement = mariadb_conn.createStatement();
        MongoDatabase mongoDatabase = this.mongoClient.getDatabase("imse_mongodb");
        MongoCollection<Document>  kursteilnehmerCollection_collection = mongoDatabase.getCollection("kursteilnehmerCollection");
        MongoCollection<Document> kochkurseCollection = mongoDatabase.getCollection("kochkurseCollection");
        MongoCollection<Document> kochschule_collection = mongoDatabase.getCollection("kochschuleCollection");

        ResultSet kursTeil_mysql = current_statement.executeQuery("SELECT * FROM Kursteilnehmer");
        while (kursTeil_mysql.next()) {
            int krsNummer = kursTeil_mysql.getInt(1);
            String vorname = kursTeil_mysql.getString(2);
            String nachname = kursTeil_mysql.getString(3);
            String eMail  = kursTeil_mysql.getString(4);
            String tel = kursTeil_mysql.getString(5);
            int abtNr = kursTeil_mysql.getInt(6);
            int kursNr = kursTeil_mysql.getInt(7);


            //find document kurs
            Document kursDoc = kochkurseCollection.find(eq("KursNr", kursNr)).first();
            //find document kochschule
            Document schuleDoc = kochschule_collection.find(eq("AbteilungsNr",abtNr)).first();
            Document teilnehmerDocument = new Document().append("KursteilnehmerNr", krsNummer)
                    .append("Vorname", vorname)
                    .append("Nachname",nachname)
                    .append("EMail", eMail)
                    .append("TelefonNr",tel)
                    .append("AbteilungsNr",schuleDoc.get("_id", ObjectId.class))
                    .append("KursNr",schuleDoc.get("_id",ObjectId.class));
            // Add  in collection
            kursteilnehmerCollection_collection.insertOne(teilnehmerDocument);


        }
    }
}