<?PHP
$time_start = microtime(true); 
$y = date("y");
$Fechain = "20$y-01-01";
$FechaFin = "20".date("y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 

//-----------------------//
//--------cxc-------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i]."",$usuariodini, $basedecode);
$QueryClientes="select sum(A.SALDO_CXC)
from CLIENTES c
LEFT join ORSP_CL_ANTSAL_CLI_EX(c.CLIENTE_ID, '$Fechain', '$FechaFin', 30, 'N', 'S') A on (1=1);";
$Cliente = ibase_query($conn, $QueryClientes);
$cont= 0 ; 
if (!$Cliente) {
    echo $QueryClientes;
}else {
while ($RowQCliente = ibase_fetch_object($Cliente)) {
  $cont = $RowQCliente->SUM;
}
}

$conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$Query = "INSERT INTO CXC (VALOR, BD) VALUES ($cont,'$empresadini[$i]');";  
$CXC= ibase_query($conn2, $Query);
print("CXC : ".$cont);
}
/*
SELECT A.SALDO_CXC
    FROM ORSP_CL_ANTSAL_CLI_EX($RowQCliente->CLIENTE_ID, '".$Fechain."', '".$FechaFin."', 30, 'N', 'S') A;

    select sum(A.SALDO_CXC)
 from CLIENTES c
LEFT join ORSP_CL_ANTSAL_CLI_EX(c.CLIENTE_ID, '2019-01-01', '2019-12-31', 30, 'N', 'S') A on (1=1);  
*/$time_end = microtime(true);

    //dividing with 60 will give the execution time in minutes otherwise seconds
    $execution_time = ($time_end - $time_start);
    
    //execution time of the script
    echo '<b>Actualización de cxc terminada:</b> '.(floor($execution_time*100)/100).' Segundos';