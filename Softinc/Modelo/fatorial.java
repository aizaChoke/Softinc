 import java.util.*;

public class fatorial{
 

   public static void main(String [] arg) {
        
        Scanner lector=new Scanner(System.in);
        int num=lector.nextInt();
        int factorial=1;
        for(int i=1;i<=num;i++)
        {
          factorial=i*factorial;
        }
        System.out.println(factorial);
      }
}