<?PHP
for ($i = 0; $i<20;$i++){
$firstday = date('2019-08-27');
$lastDay  = date('2019-08-27');
$Fechain = date("Y-m-d", strtotime("+".$i."days", strtotime($firstday)));
$FechaFin = $Fechain;
include('../config/servicio.php');
for ($i = 0; $i < count($empresadini); $i++) {
    //-----------------------//
    //EXIVAL
    $QueryCliente = "SELECT DISTINCT ARTICULO_ID FROM ARTICULOS;";
    $tot2 = 0;
    $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$i] . "", $usuariodini, $basedecode);
    if (!$conn) {
        echo "Error3";
        exit;
    } else {
        $QueryClienteF = ibase_query($conn, $QueryCliente);
        if (!$QueryClienteF) {
            echo "no se puede mostrar datos desde la consulta2: $QueryCliente!";
            exit;
        }
        $Porc = 0;
        while ($RowQCliente = ibase_fetch_object($QueryClienteF)) {
            $Porc++;
            $txt = "Exival $Porc \n";
            $QuerySelect = "select * from EXIVAL_ART($RowQCliente->ARTICULO_ID,0 ,'$FechaFin','S') ;";
            $Query = ibase_query($conn, $QuerySelect);

            if (!$Query) {
                echo "no se puede mostrar datos desde la consulta2: $Query!";
                exit;
            }
            $count = 0;
            $TOT = 0;
            while ($RowQ = ibase_fetch_object($Query)) {

                $TOT +=  $RowQ->VALOR_TOTAL;
            }

            $tot2 += $TOT;
            $TOT = 0;
        }
    }
    print("Exival : " . $tot2);

    $conn2 = ibase_connect($servicedini . ":" . $rutadini . "SEMANAL.FDB", $usuariodini, $basedecode);
    $QueryExival = "INSERT INTO EXIVAL (VALOR, BD, FECHA) VALUES ($tot2,'$empresadini[$i]', '$firstday');";
    $Exival = ibase_query($conn2, $QueryExival);
    ibase_close($conn2);
    ibase_close($conn);
    //-----------------------//
}
}