<?PHP
$name = "Ventas".date("Ymd hhmmss").".txt"; 
$myfile = fopen($name , "w");
 
$y = date("y");
$Fechain = "20$y-01-01";
$FechaFin = "20".date("y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
    
//--------VENTAS-------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
$txt = "Ventas\n";
fwrite($myfile, $txt);
$cont=0;
$QuerySelectClientes= "SELECT A.CLIENTE_ID FROM ORSP_LISTA_CLIENTES('N') A 
WHERE A.ESTATUS <> 'B';";
$QueryClientes=ibase_query($conn,$QuerySelectClientes);
while ($RowQClientes = ibase_fetch_object($QueryClientes)) {
    $QuerySelectVentas ="SELECT B.FECHA AS FECHA_FIN_MES, B.VENTA_IMPORTE FROM ORSP_VE_VENTAS_CLI($RowQClientes->CLIENTE_ID,'$Fechain','$FechaFin','N','C','M') B;";
    $QueryVentas=ibase_query($conn,$QuerySelectVentas);
    while ($RowQVentas = ibase_fetch_object($QueryVentas)) {
    $venta = $RowQVentas->VENTA_IMPORTE;
    $cont+=$venta;
}
}
$conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryVentas = "INSERT INTO VENTAS (VALOR, BD) VALUES ($cont,'$empresadini[$i]');";  
$Ventas= ibase_query($conn2, $QueryVentas);
print("ventas : ".$cont);
//-----------------------//
}