<?php
$Fechain = $_POST['finicial'];
$FechaFin = $_POST['ffinal'];
$bases = $_POST['bases'];
include('../config/servicio.php');
for ($i=0; $i<count($bases);$i++) {
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[0]."",$usuariodini, $basedecode);
$queryS ="SELECT PROVEEDOR_ID, NOMBRE FROM PROVEEDORES";
$Query=ibase_query($conn,$queryS);
$cont=0;
$i=0;
while ($RowQ = ibase_fetch_object ($Query)) 
{   
    $queryCompras ="SELECT IMPORTE_NETO, TOTAL_IMPUESTOS, DSCTO_IMPORTE FROM DOCTOS_CM WHERE FECHA >= '$Fechain' AND FECHA <= 'FechaFin' AND PROVEEDOR_ID=$RowQ->PROVEEDOR_ID ;";
    $QueryCompra=ibase_query($conn,$queryCompras);
   
    while ($RowQCompra = ibase_fetch_object ($QueryCompra)){
        $cont += $RowQCompra->IMPORTE_NETO+$RowQCompra->TOTAL_IMPUESTOS;
        $i++;
         }
         echo $RowQ->NOMBRE." ".number_format($cont,2); 
}

}
?>