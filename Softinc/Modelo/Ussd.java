import java.util.Scanner;
import java.util.regex.Pattern;

public class Ussd {
    
    public static void main(String args[]) {

        System.out.println("Ingrese el numero de casos de prueba: ");
        Scanner lector = new Scanner(System.in);
        int num = lector.nextInt();
        String[] codigos = new String[num];        
        int posicion = 0;
        
        while(num > posicion) {
            
            System.out.println("Ingrese su codigo USSD:");
            codigos[posicion] = lector.next();
            posicion++;
        }
        
        String[] codigos = new String[8];
        codigos[0] = "*109*1234#";
        codigos[1] = "*1234*109#";
        codigos[2] = "*109*109#";
        codigos[3] = "*109*1234#2";
		codigos[4] = "*109*109";
        codigos[5] = "109*109#";
        codigos[6] = "*abc*1234#";
        codigos[7] = "*109*ab34#";
        
        for (int i = 0; i < codigos.length; i++) {
        
            if (isCodigoCorrecto(codigos[i])) {
                
                System.out.println("bien");
            } else {
                
                System.out.println("mal");
            }
        }
    }
    
    public static boolean isCodigoCorrecto(String codigoUSSD) {
        
        String expresionRegular = "[*]\\d\\d\\d[*][0-9]+[#]";
        
        return Pattern.matches(expresionRegular, codigoUSSD);
    }
}