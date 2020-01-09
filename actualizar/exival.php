<?PHP
 
 $time_start = microtime(true); 
 
$y = date("y");
$Fechain = "20$y-01-01";
$FechaFin = "20".date("y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
    //-----------------------//
    //EXIVAL
    $QueryCliente = "SELECT SUM(A.VALOR_TOTAL) FROM ARTICULOS B LEFT JOIN EXIVAL_ART(B.ARTICULO_ID,0,  '$FechaFin', 'S') A ON (1=1);";
    $tot2=0;
            $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i]."",$usuariodini, $basedecode);
            if (!$conn)
        {
            echo "Error3";
            exit; 
        
        }else {
            $QueryClienteF=ibase_query($conn,$QueryCliente);
            if (!$QueryClienteF)
    
            {
            echo "no se puede mostrar datos desde la consulta2: $QueryCliente!";
            exit;
            }  
            $Porc = 0; 
            while ($RowQCliente = ibase_fetch_object ($QueryClienteF)) 
            { 
             $tot2 = $RowQCliente->SUM;
            }
    }
    $conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
    $QueryExival = "INSERT INTO EXIVAL (VALOR, BD) VALUES ($tot2,'$empresadini[$i]');";  
    $Exival = ibase_query($conn2, $QueryExival);
//-----------------------//
}$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start);

//execution time of the script
echo '<b>Actualización de exival terminada:</b> '.(floor($execution_time*100)/100).' Segundos';