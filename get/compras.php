<?php
$Fechain = "2019-04-01";
$FechaFin = "2019-04-30";
include('../config/servicio.php');
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[0]."",$usuariodini, $basedecode);
$queryS ="SELECT PROVEEDOR_ID FROM PROVEEDORES";
$Query=ibase_query($conn,$queryS);
$cont=0;
$i=0;
while ($RowQ = ibase_fetch_object ($Query)) 
{   
    $queryCompras ="SELECT IMPORTE_NETO, TOTAL_IMPUESTOS, DSCTO_IMPORTE FROM DOCTOS_CM WHERE FECHA >= '2019-04-01' AND FECHA <= '2019-04-27' AND PROVEEDOR_ID=$RowQ->PROVEEDOR_ID ;";
    $QueryCompra=ibase_query($conn,$queryCompras);
   
    while ($RowQCompra = ibase_fetch_object ($QueryCompra)){
        $cont += $RowQCompra->IMPORTE_NETO+$RowQCompra->TOTAL_IMPUESTOS;
        $i++;
         }
}
echo number_format($cont,2); 
?>