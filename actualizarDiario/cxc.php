<?PHP

$firstday = date('Y-m-d');
$lastDay  = date('Y-m-d');
$Fechain = $firstday;
$FechaFin = $lastDay;
include('../config/servicio.php');
for ($i = 0; $i < count($empresadini); $i++) {

    //-----------------------//
    //--------cxc-------//
    $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$i] . "", $usuariodini, $basedecode);
    $QueryClientes = "SELECT DISTINCT CLIENTE_ID 
FROM CLIENTES";
    $Cliente = ibase_query($conn, $QueryClientes);
    $cont = 0;
    if (!$Cliente) {
        echo $QueryClientes;
    } else {
        while ($RowQCliente = ibase_fetch_object($Cliente)) {
            $QueryClienteInfo = "SELECT A.SALDO_CXC
    FROM ORSP_CL_ANTSAL_CLI_EX($RowQCliente->CLIENTE_ID, '" . $Fechain . "', '" . $FechaFin . "', 30, 'N', 'S') A;";
            $ClienteInfo = ibase_query($conn, $QueryClienteInfo);
            while ($RowQClienteInfo = ibase_fetch_object($ClienteInfo)) {
                $cont += $RowQClienteInfo->SALDO_CXC;
            }
        }
    }
    $conn2 = ibase_connect($servicedini . ":" . $rutadini . "SEMANAL.FDB", $usuariodini, $basedecode);
    $Query = "INSERT INTO CXC (VALOR, BD,FECHA) VALUES ($cont,'$empresadini[$i]','$firstday');";
    $CXC = ibase_query($conn2, $Query);
    print("CXC : " . $cont);
}
