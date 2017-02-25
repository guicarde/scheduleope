package lanzador;
import java.sql.*;
/**
 *
 * @author Alberto
 */
public class Lanzador {
    public static void main(String[] args) {
        String url = "jdbc:postgresql://9.6.98.97:5432/SISTEMASCHEDULE";
        
        try{
            Class.forName("org.postgresql.Driver");
            Connection con = DriverManager.getConnection(url,"postgres","admin");
            Statement stmt = con.createStatement();
            ResultSet rs;
            String query = "select * from schedule_insertar_diario_p()";
            rs = stmt.executeQuery(query);
            stmt.execute("END");
            stmt.close();
            con.close();
        }
        catch(Exception e){
            System.out.println(e.getMessage());
            e.printStackTrace();
        }
        
    }
    
}
