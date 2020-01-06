<?PHP
$y = date("Y");
$y = 2019;
$Fechain = "$y-01-01";
$FechaFin = date("Y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
    //--------------------------------//
//-----------Facturas-------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
$TotalRec=0;
$QueryCobro = "SELECT SUM(A.IMPORTE_COBRO) as total FROM 
ORSP_VE_COBROS_COMIS_VEN(0,'$Fechain', '$FechaFin') A 
INNER JOIN DOCTOS_VE V ON (V.DOCTO_VE_ID = A.DOCTO_VE_ID) 
WHERE V.FECHA >= '$Fechain' AND V.FECHA <= '$FechaFin';";
$Cobros = ibase_query($conn, $QueryCobro);
while ($RowCobros = ibase_fetch_object($Cobros)) {
$TotalRec = $RowCobros->TOTAL;
}
$conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$Query = "INSERT INTO RECUPERACION (VALOR, BD) VALUES ($TotalRec,'$empresadini[$i]');";  
$CXC= ibase_query($conn2, $Query);


}