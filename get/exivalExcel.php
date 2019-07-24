<?php
if (isset($_POST["bases"])) {
    echo "Error1";
    exit;
} else {

    $empresas = array();
    $total = array();
    include('../config/servicio.php');
    $bases = array(0);
    for ($i = 0; $i < count($bases); $i++) {
        header('Content-Type:text/csv; charset=latin1');
        header('Content-Disposition: attachment; filename="Reporte ' . $limp . ' ' . date("Y-m-d") . '.csv"');
        $salida = fopen('php://output', 'w');
        fputcsv($salida, array("Reporte: " . $limp));
      
        $QueryCliente = "SELECT ARTICULO_ID, NOMBRE FROM ARTICULOS;";
        $tot2 = 0;
        $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$bases[$i]] . "", $usuariodini, $basedecode);
        if (!$conn) {
            echo "Error3";
            exit;
        } else {
            $QueryClienteF = ibase_query($conn, $QueryCliente);
            if (!$QueryClienteF) {
                echo "no se puede mostrar datos desde la consulta2: $QueryCliente!";
                exit;
            }
            while ($RowQCliente = ibase_fetch_object($QueryClienteF)) {
                $QuerySelect = "select * from EXIVAL_ART($RowQCliente->ARTICULO_ID,0 ,'" . date("Y-m-d") . "','S') ;";
                $Query = ibase_query($conn, $QuerySelect);
                if (!$Query) {
                    echo "no se puede mostrar datos desde la consulta2: $Query!";
                    exit;
                }
                $count = 0;
                $TOT = 0;
                while ($RowQ = ibase_fetch_object($Query)) {

                    fputcsv($salida, array($RowQ->ARTICULO_ID,$RowQCliente->NOMBRE ,$RowQ->EXISTENCIA, $RowQ->VALOR_UNITARIO, $RowQ->VALOR_TOTAL));
                }
            }
        }
    }
}
