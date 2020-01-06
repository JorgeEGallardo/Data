<?PHP

for ($y = 2016; $y < 2019; $y++) {
    $Fechain = "$y-01-01";
    $FechaFin = "$y-12-31";
    include('../config/servicio.php');
    for ($i = 0; $i < count($empresadini); $i++) {


        //--------VENTAS-------//
        $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$i], $usuariodini, $basedecode);
       
        $cont = 0;
        $QuerySelectClientes = "SELECT A.CLIENTE_ID FROM ORSP_LISTA_CLIENTES('N') A 
WHERE A.ESTATUS <> 'B';";
        $QueryClientes = ibase_query($conn, $QuerySelectClientes);
        while ($RowQClientes = ibase_fetch_object($QueryClientes)) {
            $QuerySelectVentas = "SELECT B.FECHA AS FECHA_FIN_MES, B.VENTA_IMPORTE FROM ORSP_VE_VENTAS_CLI($RowQClientes->CLIENTE_ID,'$Fechain','$FechaFin','N','C','M') B;";
            $QueryVentas = ibase_query($conn, $QuerySelectVentas);
            while ($RowQVentas = ibase_fetch_object($QueryVentas)) {
                $venta = $RowQVentas->VENTA_IMPORTE;
                $cont += $venta;
            }
        }
        $conn = ibase_connect($servicedini . ":" . $rutadini . "REGISTRO.FDB", $usuariodini, $basedecode);
        $QueryVentas = "INSERT INTO VENTAS (VALOR, BD, FECHA) VALUES ($cont,'$empresadini[$i]', '$FechaFin');";
        $Ventas = ibase_query($conn, $QueryVentas);
        print("ventas : " . $cont);
        //-----------------------//
    }
}