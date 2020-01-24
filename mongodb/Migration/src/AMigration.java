import com.mongodb.MongoClient;

import java.sql.Connection;
import java.sql.SQLException;

abstract public class AMigration {
    protected Connection mariadb_conn;
    protected MongoClient mongoClient;
    public  AMigration(Connection mariadb_conn, MongoClient mongoClient){
        this.mariadb_conn = mariadb_conn;
        this.mongoClient = mongoClient;
    }
    abstract public  void migrate() throws SQLException;
}
