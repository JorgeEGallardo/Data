<?php

if (1 == 2) {
    echo "Error1";
    exit;
} else {
    $WhereTemp = "";
    $WhereClientes = "";
    $Where = "";
    if ($_POST["estatus"] != "") {
        $WhereClientes = $WhereClientes . " AND ESTATUS= '" . $_POST["estatus"] . "'";
    }
    if ($_POST["Pago"] != "") {
        $WhereClientes = $WhereClientes . " AND COND_PAGO_ID= '" . $_POST["Pago"] . "'";
    }
    if ($_POST["vend"] != "") {
        $WhereClientes = $WhereClientes . " AND VENDEDOR_ID= '" . $_POST["vend"] . "'";
    }
    if ($_POST["zona"] != "") {
        $WhereClientes = $WhereClientes . " AND ZONA_CLIENTE_ID= " . $_POST["zona"] . "";
    }
    if ($WhereTemp != "") {
        $Where = "WHERE 1=1 " . $WhereTemp;
    }
    $empresas = array();
    $total = array();
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    $in = false;
    $headerset = true;
    for ($i = 0; $i < count($bases); $i++) {
        $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$bases[$i]] . "", $usuariodini, $basedecode);
        if (!$conn) {
            echo "Error2";
            exit;
        } else {
            $temp = $bases[$i];
            $limp = str_replace(".FDB", "", $empresadini[$temp]);
            if ($headerset == true) {
                if (count($bases) == 1) {
                    header('Content-Type:text/csv; charset=latin1');
                    header('Content-Disposition: attachment; filename="Reporte ' . $limp . ' ' . date("Y-m-d") . '.csv"');
                } else {
                    header('Content-Type:text/csv; charset=latin1');
                    header('Content-Disposition: attachment; filename="Reporte grupal ' . date("Y-m-d") . '.csv"');
                }
                $headerset = false;
            }
            $salida = fopen('php://output', 'w');

            fputcsv($salida, array("Reporte: " . $limp));
            $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $arrayLines = array();
            $headerLines = array();
            $monthLines= array();
            for ($j = 0; $j < 4; $j++) {

                $lines = array();
                array_push($headerLines, "Clave cliente", "Nombre", "Saldo", "Por vencer", "Por vencer 0 a 30", "Por vencer 31 a 60", "Por vencer mas de 60", "Vencido", "Vencido de 0 a 30", "Vencido de 31 a 60", "Vencido mas de 60", "Estatus", "Zona", "Forma de pago", "Tipo", "Vendedor", "Limite de credito", " ");
                $month = date("m");
                $month -= $j;
                $fecha_fin = date('Y-m-d', strtotime('-'.$j.' months'));
                $fecha_fin = date('Y-m-t',  strtotime($fecha_fin));
                $fecha_ini = date('Y-m-01',  strtotime($fecha_fin));
                array_push($monthLines," "," "," "," "," "," "," "," ",$months[$month]," "," "," "," "," "," "," "," ");
                $tot = 0;
                $tot30 = 0;
                $tot60 = 0;


                $QueryClientes = "SELECT DISTINCT CLIENTE_ID FROM CLIENTES";
                $Cliente = ibase_query($conn, $QueryClientes);
                if (!$Cliente) {
                    echo $QueryClientes;
                } else {
                    while ($RowQCliente = ibase_fetch_object($Cliente)) {
                        $s = 0;
                        $QueryClienteInfo = "SELECT A.SALDO_VENCIDO, A.SALDO_X_VENCER, A.SALDO_CXC, B.LIMITE_CREDITO,B.ESTATUS,A.CLIENTE_ID,A.SALDO_VENCIDO_PER1,A.SALDO_VENCIDO_PER2, A.SALDO_VENCIDO_PER3, B.Nombre, C.Nombre, A.SALDO_X_VENCER_PER1, A.SALDO_X_VENCER_PER2, A.SALDO_X_VENCER_PER3,A.SALDO_X_VENCER, D.CLAVE_CLIENTE, E.NOMBRE, F.NOMBRE, G.NOMBRE
                    FROM ORSP_CL_ANTSAL_CLI_EX($RowQCliente->CLIENTE_ID, '" . $fecha_ini . "', '" . $fecha_fin . "', 30, 'N', 'S') A
                    INNER JOIN Clientes B ON(A.CLIENTE_ID=B.CLIENTE_ID)
                    INNER JOIN ZONAS_CLIENTES C ON(B.Zona_Cliente_ID = C.zona_Cliente_ID) 
                    INNER JOIN CLAVES_CLIENTES D ON(D.CLIENTE_ID = B.CLIENTE_ID)
                    INNER JOIN CONDICIONES_PAGO E ON (B.COND_PAGO_ID = E.COND_PAGO_ID)
                    INNER JOIN TIPOS_CLIENTES F ON(F.TIPO_CLIENTE_ID=B.TIPO_CLIENTE_ID)
                    INNER JOIN VENDEDORES G ON(B.VENDEDOR_ID = G.VENDEDOR_ID) $Where;";
                        $Vencidos = ibase_query($conn, $QueryClienteInfo);
                        if (!$Vencidos) {
                            echo "No se puede mostrar la consulta vencimientos: " . $QueryCredito . "<br/>";
                        }

                        while ($RowVencimiento = ibase_fetch_object($Vencidos)) {
                            $s++;
                            $SALDO_VENCIDO_PER1 = $RowVencimiento->SALDO_VENCIDO_PER1;
                            $SALDO_VENCIDO_PER2 = $RowVencimiento->SALDO_VENCIDO_PER2;
                            $SALDO_VENCIDO_PER3 = $RowVencimiento->SALDO_VENCIDO_PER3;
                            if ($RowVencimiento->ESTATUS == "A") {
                                $ESTATUS = "Activo";
                            } else if ($RowVencimiento->ESTATUS == "B") {
                                $ESTATUS = "Inactivo";
                            } else if ($RowVencimiento->ESTATUS == "C") {
                                $ESTATUS = "Suspendido";
                            } else if ($RowVencimiento->ESTATUS == "V") {
                                $ESTATUS = "Suspendido";
                            }
                            array_push($lines, array($RowVencimiento->CLAVE_CLIENTE, $RowVencimiento->NOMBRE,  $RowVencimiento->SALDO_CXC, $RowVencimiento->SALDO_X_VENCER, $RowVencimiento->SALDO_X_VENCER_PER1, $RowVencimiento->SALDO_X_VENCER_PER2, $RowVencimiento->SALDO_X_VENCER_PER3, $RowVencimiento->SALDO_VENCIDO, $RowVencimiento->SALDO_VENCIDO_PER1, $RowVencimiento->SALDO_VENCIDO_PER2, $RowVencimiento->SALDO_VENCIDO_PER3, $ESTATUS, $RowVencimiento->NOMBRE_01, $RowVencimiento->NOMBRE_02, $RowVencimiento->NOMBRE_03, $RowVencimiento->NOMBRE_04, $RowVencimiento->LIMITE_CREDITO," "));
                        }
                        if ($s == 0) {
                            $QueryClienteInfo = "SELECT A.SALDO_VENCIDO, A.SALDO_X_VENCER, A.SALDO_CXC, B.LIMITE_CREDITO,B.ESTATUS,A.CLIENTE_ID,A.SALDO_VENCIDO_PER1,A.SALDO_VENCIDO_PER2, A.SALDO_VENCIDO_PER3, B.Nombre, A.SALDO_X_VENCER_PER1, A.SALDO_X_VENCER_PER2, A.SALDO_X_VENCER_PER3,A.SALDO_X_VENCER, D.CLAVE_CLIENTE, E.NOMBRE
                        FROM ORSP_CL_ANTSAL_CLI_EX($RowQCliente->CLIENTE_ID, '" . $fecha_ini . "', '" . $fecha_fin . "', 30, 'N', 'S') A
                        INNER JOIN Clientes B ON(A.CLIENTE_ID=B.CLIENTE_ID)
                        INNER JOIN CLAVES_CLIENTES D ON(D.CLIENTE_ID = B.CLIENTE_ID)
                        INNER JOIN CONDICIONES_PAGO E ON (B.COND_PAGO_ID = E.COND_PAGO_ID) $Where;";
                            $Vencidos = ibase_query($conn, $QueryClienteInfo);
                            if (!$Vencidos) {
                                echo "No se puede mostrar la consulta vencimientos: " . $QueryCredito . "<br/>";
                            }

                            while ($RowVencimiento = ibase_fetch_object($Vencidos)) {
                                $SALDO_VENCIDO_PER1 = $RowVencimiento->SALDO_VENCIDO_PER1;
                                $SALDO_VENCIDO_PER2 = $RowVencimiento->SALDO_VENCIDO_PER2;
                                $SALDO_VENCIDO_PER3 = $RowVencimiento->SALDO_VENCIDO_PER3;
                                if ($RowVencimiento->ESTATUS == "A") {
                                    $ESTATUS = "Activo";
                                } else if ($RowVencimiento->ESTATUS == "B") {
                                    $ESTATUS = "Inactivo";
                                } else if ($RowVencimiento->ESTATUS == "C") {
                                    $ESTATUS = "Suspendido";
                                } else if ($RowVencimiento->ESTATUS == "V") {
                                    $ESTATUS = "Suspendido";
                                }
                                array_push($lines, array($RowVencimiento->CLAVE_CLIENTE, $RowVencimiento->NOMBRE,  $RowVencimiento->SALDO_CXC, $RowVencimiento->SALDO_X_VENCER, $RowVencimiento->SALDO_X_VENCER_PER1, $RowVencimiento->SALDO_X_VENCER_PER2, $RowVencimiento->SALDO_X_VENCER_PER3, $RowVencimiento->SALDO_VENCIDO, $RowVencimiento->SALDO_VENCIDO_PER1, $RowVencimiento->SALDO_VENCIDO_PER2, $RowVencimiento->SALDO_VENCIDO_PER3, $ESTATUS, "-", $RowVencimiento->NOMBRE_01, "-", "-", $RowVencimiento->LIMITE_CREDITO, " "));
                            }
                        }
                    }
                }
                array_push($arrayLines, $lines);
            }
            fputcsv($salida, $monthLines);
            fputcsv($salida, $headerLines);
            $size =  count($arrayLines[0]);
            for ($k=0;$k<$size;$k++){
                $temp = array();
            foreach ($arrayLines as $line ){
                $temp = array_merge($temp, $line[$k]);
            }
            fputcsv($salida, $temp);
        }
        }
    }
}
