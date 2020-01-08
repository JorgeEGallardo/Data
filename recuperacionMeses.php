<?PHP
$time_start = microtime(true); 
include('config/servicio2.php');
for ($y = 16; $y < 20; $y++) {
    for ($m = 1; $m < 13; $m++) {
        if ($m < 10) {
            $Fechain = "20$y" . "-0$m-01";
        } else {
            $Fechain = "20$y" . "-$m-01";
        }
        $FechaFin = date("Y-m-t", strtotime($Fechain));
        for ($i = 0; $i < count($empresadini); $i++) {
            $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	
            $TotalRec=0;
            $QueryCobro = "SELECT SUM(A.IMPORTE_COBRO) as total FROM 
            ORSP_VE_COBROS_COMIS_VEN(0,'$Fechain', '$FechaFin') A 
            INNER JOIN DOCTOS_VE V ON (V.DOCTO_VE_ID = A.DOCTO_VE_ID) /* 
            WHERE V.FECHA >= '$Fechain' AND V.FECHA <= '$FechaFin'*/;";
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
            
            $conn2 = ibase_connect($servicedini . ":" . $rutadini . "DASHBOARD.FDB", $usuariodini, $basedecode);
            $Query = "INSERT INTO MESES (VALOR, BD, FECHA) VALUES ($TotalRec,'$empresadini[$i]', '$FechaFin');";
            $CXC = ibase_query($conn2, $Query);
           
        }
    }}
    $time_end = microtime(true);

    //dividing with 60 will give the execution time in minutes otherwise seconds
    $execution_time = ($time_end - $time_start);
    
    //execution time of the script
    echo '<b>Actualización de recuperacion por meses terminada:</b> '.$execution_time.' Segundos';