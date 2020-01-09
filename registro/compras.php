<?PHP
$name = "Compras".date("Ymd hhmmss").".txt"; 
$myfile = fopen($name , "w");
 
for ($y = 2019; $y<2020;$y++){
$Fechain = "$y-01-01";
$FechaFin = "$y-12-31";
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
$conn=ibase_connect($servicedini.":".$rutadini."REGISTRO.FDB",$usuariodini, $basedecode);	
$QueryCompras = "INSERT INTO COMPRAS (VALOR, BD, FECHA) VALUES ($cont*1.16,'$empresadini[$i]', '$FechaFin');";  
$Insert= ibase_query($conn, $QueryCompras);
}
}