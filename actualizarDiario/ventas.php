<?PHP
$firstday = date('Y-m-d', strtotime("this week")); 
$lastDay  = date('Y-m-d', strtotime($Date. ' + 6 days'));
$Fechain = $firstday;
$FechaFin = $lastDay;
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
    //--------------------------------//
//-----------Facturas-------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
$TotalRec=0;
$QueryCobro = "SELECT CLAVE_CLIENTE,DOCTO_CC_ID,FOLIO FROM DOCTOS_CC WHERE FECHA>='$Fechain' AND FECHA<='$FechaFin'  AND  (CONCEPTO_CC_ID=4 OR CONCEPTO_CC_ID=5) ORDER BY FECHA, FOLIO;";
$Cobros = ibase_query($conn, $QueryCobro);
while ($RowCobros = ibase_fetch_object($Cobros)) {
    $Control=TRUE;
    $QueryImportes = "SELECT IMPORTE ,IMPUESTO,DOCTO_CC_ID, DOCTO_CC_ACR_ID, FECHA FROM IMPORTES_DOCTOS_CC WHERE DOCTO_CC_ID= $RowCobros->DOCTO_CC_ID;";
    $Importes = ibase_query($conn, $QueryImportes);
    $IMPV = TRUE;
    $ACR = $RowCobros->FOLIO;
    while ($RowImportes = ibase_fetch_object($Importes)) {
        $IMPORTE = $RowImportes->IMPORTE+$RowImportes->IMPUESTO;
        $FECHA = $RowImportes->FECHA;
        $QueryDoctosCC = "SELECT * FROM IMPORTES_DOCTOS_CC WHERE DOCTO_CC_ACR_ID= $RowImportes->DOCTO_CC_ACR_ID AND DOCTO_CC_ID <> $RowImportes->DOCTO_CC_ID;";
        $DoctosCC = ibase_query($conn, $QueryDoctosCC);
        $cont = 0;
        while ($RowDoctosCC = ibase_fetch_object($DoctosCC)) {
            $cont++;
            $QueryDoctoCC = "SELECT * FROM DOCTOS_CC WHERE DOCTO_CC_ID= $RowDoctosCC->DOCTO_CC_ID;";
            $DoctoCC = ibase_query($conn, $QueryDoctoCC);
            $Total = $RowDoctosCC->IMPORTE + $RowDoctosCC->IMPUESTO;
            while ($RowDoctoCC = ibase_fetch_object($DoctoCC)) {
                $cur = DateTime::CreateFromFormat('Y-m-d', $FECHA);
                $prev = DateTime::CreateFromFormat('Y-m-d', $RowDoctoCC->FECHA);
                $days = $cur->diff($prev)->format('%a');
                if($Control){
                    $Control=FALSE;
                }else{
                    $IMPORTE =0;
                }
                if ($RowDoctoCC->CONCEPTO_CC_ID == 14){
                   $TotalRec+=$IMPORTE;
                }
                    else {
                        $TotalRec+=$IMPORTE;
                  }
            }
        }
    
    }
}


$conn2=ibase_connect($servicedini.":".$rutadini."DIARIO.FDB",$usuariodini, $basedecode);	
$QueryVentas = "INSERT INTO VENTAS (VALOR, BD) VALUES ($TotalRec,'$empresadini[$i]');";  
$Ventas= ibase_query($conn2, $QueryVentas);
echo "ventas : ".$TotalRec;
//-----------------------//

}