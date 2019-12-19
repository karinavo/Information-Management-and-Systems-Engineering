import java.io.File;
import java.util.Scanner;
public class Test {

    public static void main(String[] args) {

        try {
            System.out.print("Enter the file name with extension : ");
            File file=new File("create.sql");
            Scanner sc=new Scanner(TestingCreation.class.getResourceAsStream("create.sql"));
            while(sc.hasNextLine()){
                System.out.println(sc.nextLine());
            }

        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }

}