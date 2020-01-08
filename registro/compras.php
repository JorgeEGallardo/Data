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
$queryS ="SELECT PROVEEDOR_ID FROM PROVEEDORES";
$Query=ibase_query($conn,$queryS);
$cont=0;
while ($RowQ = ibase_fetch_object ($Query)) 
{   
    $queryCompras ="SELECT IMPORTE_NETO, TOTAL_IMPUESTOS, DSCTO_IMPORTE FROM DOCTOS_CM WHERE FECHA >= '$Fechain' AND FECHA <= '$FechaFin' AND PROVEEDOR_ID=$RowQ->PROVEEDOR_ID ;";
    $QueryCompra=ibase_query($conn,$queryCompras);
   
    while ($RowQCompra = ibase_fetch_object ($QueryCompra)){
        $cont += $RowQCompra->IMPORTE_NETO+$RowQCompra->TOTAL_IMPUESTOS;
         }
}
$conn=ibase_connect($servicedini.":".$rutadini."REGISTRO.FDB",$usuariodini, $basedecode);	
$QueryCompras = "INSERT INTO COMPRAS (VALOR, BD, FECHA) VALUES ($cont,'$empresadini[$i]', '$FechaFin');";  
$Insert= ibase_query($conn, $QueryCompras);
print("compras : ".$cont);
//-----------------------//
//--------cxc-------//
}
}