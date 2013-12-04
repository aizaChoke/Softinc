import java.util.*;
/**
 * Write a description of class max here.
 * 
 * @author (your name) 
 * @version (a version number or a date)
 */
public class min
{
public static void main(String [] args)
{
    Scanner lector=new Scanner(System.in);
    int num=lector.nextInt();
    for(int i=0;i<num;i++)
    {
        int n1=lector.nextInt();
        int n2=lector.nextInt();
        if(n1>n2)
        {
            System.out.println(n2);
        }else{
            System.out.println(n1);
        }
    }
}
    
}
