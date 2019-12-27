<?php
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Reporte' . date("Y-m-d") . '.csv"');
$dbp = $_POST["bases"];
$salida = fopen('php://output', 'w');
$Fechain = $_POST["finicial"];
$FechaFin = $_POST["ffinal"];
fputcsv($salida, array("Reporte: $Fechain-$FechaFin"));

fputcsv($salida, array("Folio Venta", "Importe Venta", "Fecha Venta", "Folio Cobro", "Importe Cobro", "Fecha Cobro", "Clave","Cliente", "Diferencia"));
include('../config/servicio.php');
$conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$dbp[0]], $usuariodini, $basedecode);
$QueryCobro = "SELECT DOCTO_CC_ID,FOLIO,CLAVE_CLIENTE 
FROM DOCTOS_CC
WHERE FECHA>='$Fechain' AND FECHA<='$FechaFin'  AND  (CONCEPTO_CC_ID=4 OR CONCEPTO_CC_ID=5) ORDER BY FECHA, FOLIO;";
$Cobros = ibase_query($conn, $QueryCobro);
while ($RowCobros = ibase_fetch_object($Cobros)) {
    $Control=TRUE;
    $QueryImportes = "SELECT IMPORTE ,IMPUESTO,DOCTO_CC_ID, DOCTO_CC_ACR_ID, FECHA FROM IMPORTES_DOCTOS_CC WHERE DOCTO_CC_ID= $RowCobros->DOCTO_CC_ID;";
    $Importes = ibase_query($conn, $QueryImportes);
    $IMPV = TRUE;
    $CLAV_CLI = $RowCobros->CLAVE_CLIENTE;
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
                $QueryCliente="SELECT C.NOMBRE FROM CLIENTES C
                INNER JOIN CLAVES_CLIENTES B ON (C.CLIENTE_ID = B.CLIENTE_ID) 
                WHERE B.CLAVE_CLIENTE='$CLAV_CLI'";
                $NOM_CLI="";
                $Cliente = ibase_query($conn, $QueryCliente);
                while ($RowCliente = ibase_fetch_object($Cliente)) {
                $NOM_CLI = $RowCliente->NOMBRE;
                }
                if($Control){
                    $Control=FALSE;
                }else{
                    $IMPORTE =0;
                }
                if ($RowDoctoCC->CONCEPTO_CC_ID == 14){
                    fputcsv($salida, array($ACR, $IMPORTE, $FECHA, $RowDoctoCC->FOLIO, $Total, $RowDoctoCC->FECHA, $CLAV_CLI,$NOM_CLI, $days));
                 
                }
                    else {
                    fputcsv($salida, array($ACR, $IMPORTE, $FECHA, $RowDoctoCC->FOLIO, $Total, $RowDoctoCC->FECHA, $CLAV_CLI,$NOM_CLI, $days));
                }
            }
        }
        //No pagada
        if ($cont == 0) {
            $QueryCliente="SELECT C.NOMBRE FROM CLIENTES C
                INNER JOIN CLAVES_CLIENTES B ON (C.CLIENTE_ID = B.CLIENTE_ID) 
                WHERE B.CLAVE_CLIENTE='$CLAV_CLI'";
                $NOM_CLI="";
                $Cliente = ibase_query($conn, $QueryCliente);
                while ($RowCliente = ibase_fetch_object($Cliente)) {
                $NOM_CLI = $RowCliente->NOMBRE;
                }
            fputcsv($salida, array($RowCobros->FOLIO, $IMPORTE, $RowImportes->FECHA, "-", "-", "-", $CLAV_CLI,$NOM_CLI, "-"));
        }
    }
}
