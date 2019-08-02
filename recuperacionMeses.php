<?PHP
include('config/servicio2.php');
for ($y = 16; $y < 19; $y++) {
    for ($m = 1; $m < 13; $m++) {
        if ($m < 10) {
            $Fechain = "20$y" . "-0$m-01";
        } else {
            $Fechain = "20$y" . "-$m-01";
        }
        $FechaFin = date("Y-m-t", strtotime($Fechain));
        for ($i = 0; $i < count($empresadini); $i++) {
            //--------------------------------//
            //-----------Facturas-------------//
            $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$i], $usuariodini, $basedecode);
            $TotalRec = 0;
            $QueryCobro = "SELECT CLAVE_CLIENTE,DOCTO_CC_ID,FOLIO FROM DOCTOS_CC WHERE FECHA>='$Fechain' AND FECHA<='$FechaFin'  AND  (CONCEPTO_CC_ID=4 OR CONCEPTO_CC_ID=5) ORDER BY FECHA, FOLIO;";
            $Cobros = ibase_query($conn, $QueryCobro);
            while ($RowCobros = ibase_fetch_object($Cobros)) {
                $Control = TRUE;
                $QueryImportes = "SELECT IMPORTE ,IMPUESTO,DOCTO_CC_ID, DOCTO_CC_ACR_ID, FECHA FROM IMPORTES_DOCTOS_CC WHERE DOCTO_CC_ID= $RowCobros->DOCTO_CC_ID;";
                $Importes = ibase_query($conn, $QueryImportes);
                $IMPV = TRUE;
                $ACR = $RowCobros->FOLIO;
                while ($RowImportes = ibase_fetch_object($Importes)) {
                    $IMPORTE = $RowImportes->IMPORTE + $RowImportes->IMPUESTO;
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
                            if ($Control) {
                                $Control = FALSE;
                            } else {
                                $IMPORTE = 0;
                            }
                            if ($RowDoctoCC->CONCEPTO_CC_ID == 14) {
                                $TotalRec += $Total;
                            } else {
                                $TotalRec += $Total;
                            }
                        }
                    }
                }
            }
            $conn2 = ibase_connect($servicedini . ":" . $rutadini . "DASHBOARD.FDB", $usuariodini, $basedecode);
            $Query = "INSERT INTO MESES (VALOR, BD, FECHA) VALUES ($TotalRec,'$empresadini[$i]', '$FechaFin');";
            $CXC = ibase_query($conn2, $Query);
            ibase_free_result($CXC);
            ibase_free_result($DoctoCC);
            ibase_free_result($Cobros);
            ibase_free_result($Importes);
            ibase_free_result($DoctosCC);
            ibase_close($conn); 
            ibase_close($conn2); 
        }
    }
}
