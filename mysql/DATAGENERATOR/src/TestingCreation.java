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

        public static void main(String[] args) {

            Connection conn = null;
            try{
                //STEP 2: Register JDBC driver
                Class.forName(JDBC_DRIVER);

                //STEP 3: Open a connection
                System.out.println("Connecting to a selected database...");
                conn = DriverManager.getConnection(DB_URL, USER, PASS);
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
                    try {
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
            }catch(Exception e){
                //Handle errors for Class.forName
                e.printStackTrace();
            }
            System.out.println("Goodbye!");
        }//end main
    }//end JDBCExample


