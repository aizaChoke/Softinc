<?php 
include("../modelo/cnx.php");
pg_connect($entrada);

class rankingProblema
{
    function __construct() {
        
        $this->cuerpo=array();
        $this->titulo="";
        $this->col="";
        $this->cierre="";
        $this->formu="";
        
       // $this->generarTabla();
    }
    function formularioRanking()
    {
        $usuarios=pg_query("SELECT 
                                    problema.id_problema, 
                                    problema.nombre_problema
                           FROM 
                                    public.problema;");
        $this->formu.='<table border=1 >';
        $this->formu.='<tr>';
        $this->formu.='<td>Numero problema</td>';
        $this->formu.='<td>Nombre problema</td>';
        $this->formu.='<td>Seleccione problema</td>';
        $this->formu.='</tr>';
        while($line=pg_fetch_array($usuarios, null, PGSQL_ASSOC))
	{
             $this->formu.='<tr>
                             <td>'.$line['id_problema'].'</td> <td>'.$line['nombre_problema'].'</td> <td><input type="checkbox" name="Contenedor[]" value='.$line['id_problema'].'   /></td>
                             
                             </tr>';                                                                                    
        }  
        $this->formu.='</table>';
        return $this->formu;
        
    }
    
}

?>
