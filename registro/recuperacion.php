<?PHP
//SELECT SUM(A.IMPORTE_COBRO) FROM ORSP_VE_COBROS_COMIS_VEN(0,'2019-01-01', '2019-12-31') A INNER JOIN DOCTOS_VE V ON (V.DOCTO_VE_ID = A.DOCTO_VE_ID) WHERE V.FECHA >= '2019-01-01' AND V.FECHA <= '2019-12-31';

for($y=19;$y<20;$y++){
$Fechain = "20$y-01-01";
$FechaFin = "20".$y."-12-31";
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
    $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
    $TotalRec=0;
    $QueryCobro = "SELECT SUM(A.IMPORTE_COBRO) as total FROM 
    ORSP_VE_COBROS_COMIS_VEN(0,'$Fechain', '$FechaFin') A;";
    $Cobros = ibase_query($conn, $QueryCobro);
    while ($RowCobros = ibase_fetch_object($Cobros)) {
    $TotalRec = $RowCobros->TOTAL;
    }
    $QueryCobro = "SELECT TIPO_DOCTO, SUM(TIPO_CAMBIO*IMPORTE_NETO) AS SUMCC
FROM DOCTOS_PV
WHERE ESTATUS <> 'C'
      AND ((TIPO_DOCTO = 'F')
          AND (FECHA BETWEEN '$Fechain' AND '$FechaFin'))
GROUP BY TIPO_DOCTO;";
$Cobros = ibase_query($conn, $QueryCobro);
while ($RowCobros = ibase_fetch_object($Cobros)) {
$TotalRec += $RowCobros->SUMCC;
}
$TotalRec+=0;

$conn2=ibase_connect($servicedini.":".$rutadini."REGISTRO.FDB",$usuariodini, $basedecode);	
$Query = "INSERT INTO RECUPERACION(VALOR, BD, FECHA) VALUES($TotalRec,'$empresadini[$i]', '$FechaFin');";  
$CXC= ibase_query($conn2, $Query);
}
}