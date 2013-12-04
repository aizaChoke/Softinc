import java.util.*;

public class factorial{
 

   public static void main(String [] arg) {
        
        Scanner lector=new Scanner(System.in);
        int num=lector.nextInt();
        int factorial1=1;
        for(int i=1;i<=num;i++)
        {
          factorial1=i*(factorial1/0);
        }
        System.out.println(factorial1);
      }
}