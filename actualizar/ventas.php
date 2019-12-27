<?PHP
$y = date("y");
$maxM = date('n');

$Fechain = "20$y-01-01";
include('../config/servicio.php');
$FechaFin = date("Y-m-t");
for ($i=0; $i < count($empresadini) ; $i++) { 
    //--------------------------------//
//-----------Facturas-------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
 
$QueryCobro = "SELECT SUM(SUMCC) FROM (
SELECT TIPO_DOCTO, SUM(TIPO_CAMBIO*IMPORTE_NETO) AS SUMCC
          FROM DOCTOS_PV
          WHERE ESTATUS <> 'C'
                AND ((TIPO_DOCTO = 'F')
                    AND (FECHA BETWEEN '$Fechain' AND '$FechaFin'))
          GROUP BY TIPO_DOCTO
          UNION ALL
SELECT TIPO_DOCTO, SUM(TIPO_CAMBIO*IMPORTE_NETO) AS SUMCC
          FROM DOCTOS_VE
          WHERE ESTATUS <> 'C'
                AND ((TIPO_DOCTO = 'F')
                    AND (FECHA BETWEEN '$Fechain' AND '$FechaFin'))
          GROUP BY TIPO_DOCTO
          
          )";
$Cobros = ibase_query($conn, $QueryCobro);
while ($RowCobros = ibase_fetch_object($Cobros)) {
 $TotalRec = $RowCobros->SUM;
     }


$conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryVentas = "INSERT INTO VENTAS (VALOR, BD) VALUES ($TotalRec,'$empresadini[$i]');";  
$Ventas= ibase_query($conn2, $QueryVentas);
        

}