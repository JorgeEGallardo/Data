<?PHP
$firstday = date('Y-m-d');
$lastDay  = date('Y-m-d');
$Fechain = $firstday;
$FechaFin = $lastDay;
include('../config/servicio.php');
for ($i = 0; $i < count($empresadini); $i++) {
    //--------------------------------//
    //-----------Facturas-------------//
    $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$i], $usuariodini, $basedecode);
    $TotalRec = 0;
    $QueryProv = "SELECT DISTINCT PROVEEDOR_ID FROM proveedores;";
    $Proveedores = ibase_query($conn, $QueryProv);
    while ($RowProv = ibase_fetch_object($Proveedores)) {
        $QueryImportes = "SELECT SALDO_CXP, SALDO_VENCIDO,SALDO_ANTICIPOS,SALDO_X_VENCER FROM ORSP_CP_ANTSAL_PROV($RowProv->PROVEEDOR_ID,'$Fechain','$FechaFin',60,'N');";
        $Importes = ibase_query($conn, $QueryImportes);
        while ($RowImportes = ibase_fetch_object($Importes)) {
            $TotalRec += $RowImportes->SALDO_CXP;
        }
    }


    $conn2 = ibase_connect($servicedini . ":" . $rutadini . "SEMANAL.FDB", $usuariodini, $basedecode);
    $Query = "INSERT INTO PROVEEDORES(VALOR, BD, FECHA) VALUES ($TotalRec,'$empresadini[$i]', '$firstday');";
    $CXC = ibase_query($conn2, $Query);
    //-----------------------//

}
