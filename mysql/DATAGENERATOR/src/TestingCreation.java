import java.sql.*;
import java.util.Scanner;
import java.io.FileNotFoundException;
import java.io.File;
import java.sql.DriverManager;
    public class TestingCreation{
        // JDBC driver name and database URL
        static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
        static final String DB_URL = "jdbc:mysql://localhost:3306/imse_db";

        //  Database credentials
        static final String USER = "root";
        static final String PASS = "rootpsw";
       // static  private  Connection conn=null;
      /***  private static void connect() throws InterruptedException {
            while(true) {
                try{
                    System.out.println("Connecting to a selected database...");
                    conn = DriverManager.getConnection("jdbc:mysql://mariadb:3306/imse_db", "root", "rootpsw");
                    System.out.println("Connected database successfully...");
                    break;
                }catch (SQLException e) {
                    System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
                }
                Thread.sleep(10);
            }
        }***/
        public static void main(String[] args) {
            try{
                //Open a connection
             //   connect();

                System.out.println("Connecting to a selected database...");
                Connection conn = DriverManager.getConnection("jdbc:mysql://mariadb:3306/imse_db", "root", "rootpsw");
                System.out.println("Connected database successfully...");
                    // Delimiter
                String delimiter = ";";

                // Create scanner
                Scanner scanner;
                File sql_script=new File("create.sql");
                scanner = new Scanner(TestingCreation.class.getResourceAsStream("create.sql")).useDelimiter(delimiter);

                // Loop through the SQL file statements
                Statement currentStatement = null;
                while(scanner.hasNext()) {

                    // Get statement
                    String rawStatement = scanner.next() + delimiter;
                    try{
                        System.out.println("rawstatment::"  );
                        System.out.println(rawStatement);
                        // Execute statement
                        currentStatement = conn.createStatement();
                        currentStatement.execute(rawStatement);
                    } catch (SQLException e) {
                        e.printStackTrace();
                    } finally {
                        // Release resources
                        if (currentStatement != null) {
                            try {
                                currentStatement.close();
                            } catch (SQLException e) {
                                e.printStackTrace();
                            }
                        }
                        currentStatement = null;
                    }


                }
                scanner.close();
            }catch (SQLException e) {
                 System.err.format("SQL State: %s\n%s", e.getSQLState(), e.getMessage());
            } catch (Exception e) {
                e.printStackTrace();
            }
            finally {
                System.out.println("All tables were successfully created!");
            }
        }//end main
    }//end JDBCExample


