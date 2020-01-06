<?PHP

for ($y = 2016; $y < 2019; $y++) {
    $Fechain = "$y-01-01";
    $FechaFin = "$y-12-31";
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
        $conn = ibase_connect($servicedini . ":" . $rutadini . "REGISTRO.FDB", $usuariodini, $basedecode);
        $Query = "INSERT INTO CXC (VALOR, BD, FECHA) VALUES ($cont,'$empresadini[$i]', '$FechaFin');";
        $CXC = ibase_query($conn, $Query);
        print("CXC : " . $cont);
    }
}
