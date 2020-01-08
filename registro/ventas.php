<?PHP

for ($y = 2019; $y <= 2019; $y++) {
    $Fechain = "$y-01-01";
    $FechaFin = "$y-12-31";
    include('../config/servicio.php');
    for ($i = 0; $i < count($empresadini); $i++) {
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
     $TotalRec+=0;
        $conn = ibase_connect($servicedini . ":" . $rutadini . "REGISTRO.FDB", $usuariodini, $basedecode);
        $QueryVentas = "INSERT INTO VENTAS (VALOR, BD, FECHA) VALUES ($TotalRec,'$empresadini[$i]', '$FechaFin');";
        $Ventas = ibase_query($conn, $QueryVentas);
    }
}