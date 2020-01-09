<?PHP

 
$time_start = microtime(true); 
$y = date("y");
$Fechain = "20$y-01-01";
$FechaFin = "20".date("y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 

//--------COMPRAS-------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i]."",$usuariodini, $basedecode);
$queryS ="select sum(A.COMPRA_IMPORTE)
 from PROVEEDORES p
LEFT join ORSP_CM_COMPRAS_PROV(p.PROVEEDOR_ID, '$Fechain', '$FechaFin', 'B', 'P', 'N') A on (1=1);";
$Query=ibase_query($conn,$queryS);
$cont=0;
while ($RowQ = ibase_fetch_object ($Query)) 
{   
    $cont = $RowQ->SUM;
} 
$cont+=0; 
$cont*=1.16;
$conn=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryCompras = "INSERT INTO COMPRAS (VALOR, BD) VALUES ($cont,'$empresadini[$i]');";  
$Insert= ibase_query($conn, $QueryCompras);
}
$time_end = microtime(true);

    //dividing with 60 will give the execution time in minutes otherwise seconds
    $execution_time = ($time_end - $time_start);
    
    //execution time of the script
    echo '<b>Actualización de compras terminada:</b> '.(floor($execution_time*100)/100).' Segundos';