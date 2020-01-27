import com.mchange.v2.c3p0.ComboPooledDataSource;

import javax.sql.DataSource;
import java.beans.PropertyVetoException;
import java.sql.*;
import java.time.LocalDate;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.GregorianCalendar;
import java.util.Scanner;
import java.util.concurrent.ThreadLocalRandom;

public class DataGenerator {

    private static ComboPooledDataSource cpds = new ComboPooledDataSource();

    private static void createPool()
    {
        try
        {
            cpds = new ComboPooledDataSource();
            cpds.setDriverClass("com.mysql.jdbc.Driver");
            cpds.setJdbcUrl("jdbc:mysql://mariadb:3306/imse_db");
            cpds.setUser("root");
            cpds.setPassword("rootpsw");
            cpds.setMinPoolSize(100);
            cpds.setMaxPoolSize(1000);
            cpds.setAcquireIncrement(5);
            cpds.setAcquireRetryAttempts(100);
            //cpds.setConnectionCustomizerClassName();
            //cpds.setAcquireRetryDelay();
            //cpds.setBreakAfterAcquireFailure();
        }
        catch (PropertyVetoException ex)
        {
            System.err.println(ex.getMessage());
        }

    }

    private static Connection getConnection() throws SQLException {

        return cpds.getConnection();
    }



    public static void main(String[] args) {
        try {
            // Create connection pool
            createPool();

            //Open a connection
            System.out.println("Connecting to a selected database...");

            Connection conn = getConnection();

            System.out.println("Connected database successfully...");

            }catch(SQLException e){
                System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
            } catch(Exception e){
                e.printStackTrace();
            }
    }
}
