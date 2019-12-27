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
    for ($i = 0; $i < count($bases); $i++) {
        $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[$bases[$i]] . "", $usuariodini, $basedecode);
        if (!$conn) {
            echo "Error2";
            exit;
        } else {
            $temp = $bases[$i];
            $limp = str_replace(".FDB", "", $empresadini[$temp]);
            ?>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $limp; ?></h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead style="background-color:#ffccff">
                                <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Saldo</th>
                                    <th>Por vencer</th>
                                    <?php if ($_POST['Saldo2'] == 0 || $_POST['Saldo2'] == -1) echo "<th>Por vencer 0-30 </tdh>"; ?>
                                    <?php if ($_POST['Saldo2'] == 30 || $_POST['Saldo2'] == -1) echo "<th>Por vencer 31-60 </th>"; ?>
                                    <th>Vencido</th>
                                    <?php if ($_POST['Saldo'] == 0 || $_POST['Saldo'] == -1) echo "<th>Vencido 0-30 </tdh>"; ?>
                                    <?php if ($_POST['Saldo'] == 30 || $_POST['Saldo'] == -1) echo "<th>Vencido 31-60 </th>"; ?>
                                    <?php if ($_POST['Saldo'] == 60 || $_POST['Saldo'] == -1) echo "<th>Vencido +60 </th>"; ?>
                                    <th>Estatus</th>
                                    <th>Zona</th>
                                    <th>Pago</th>
                                    <th>Tipo</th>
                                    <th>Vendedor</th>
                                    <th>Límite</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $fecha_ini = date('2000-01-01');
                                $fecha_fin = date("Y-m-d");
                                $tot = 0;
                                $tot30 = 0;
                                $tot60 = 0;


                                $QueryClientes = "SELECT DISTINCT CLIENTE_ID 
    FROM CLIENTES  WHERE 1=1 $WhereClientes ROWS 20";
                                $Cliente = ibase_query($conn, $QueryClientes);
                                if (!$Cliente) {
                                    echo $QueryClientes;
                                } else {
                                    ?><?PHP
                            while ($RowQCliente = ibase_fetch_object($Cliente)) {
                                $s=0;
                                $QueryClienteInfo = "SELECT A.SALDO_VENCIDO, A.SALDO_X_VENCER, A.SALDO_CXC, B.LIMITE_CREDITO,B.ESTATUS,A.CLIENTE_ID,A.SALDO_VENCIDO_PER1,A.SALDO_VENCIDO_PER2, A.SALDO_VENCIDO_PER3, B.Nombre, C.Nombre, A.SALDO_X_VENCER_PER1, A.SALDO_X_VENCER_PER2, A.SALDO_X_VENCER_PER3,A.SALDO_X_VENCER,    
                                D.CLAVE_CLIENTE, E.NOMBRE, F.NOMBRE, G.NOMBRE
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
                                        $estatus = "Activo";
                                    } else if ($RowVencimiento->ESTATUS == "B") {
                                        $estatus = "Inactivo";
                                    } else if ($RowVencimiento->ESTATUS == "C") {
                                        $estatus = "Suspensión de credito";
                                    } else {
                                        $estatus = "Suspensión de ventas";
                                    }
                                    ?>
                                            <tr>
                                                <td><?php echo $RowVencimiento->CLAVE_CLIENTE ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE ?></td>
                                                <td><?php echo $RowVencimiento->SALDO_CXC ?></td>
                                                <td><?php echo $RowVencimiento->SALDO_X_VENCER ?></td>
                                                <?php if ($_POST['Saldo2'] == 0 || $_POST['Saldo2'] == -1) echo "<td>$RowVencimiento->SALDO_X_VENCER_PER1 </td>"; ?>
                                                <?php if ($_POST['Saldo2'] == 30 || $_POST['Saldo2'] == -1) echo "<td>$RowVencimiento->SALDO_X_VENCER_PER2 </td>"; ?>
                                                <td><?php echo $RowVencimiento->SALDO_VENCIDO ?></td>
                                                <?php if ($_POST['Saldo'] == 0 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER1 </td>"; ?>
                                                <?php if ($_POST['Saldo'] == 30 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER2 </td>"; ?>
                                                <?php if ($_POST['Saldo'] == 60 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER3 </td>"; ?>
                                                <td><?php echo $estatus ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE_01 ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE_02 ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE_03 ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE_04 ?></td>
                                                <td><?php echo $RowVencimiento->LIMITE_CREDITO ?></td>


                                            </tr>
                                        <?php
                                        }
                                        if($s==0){
                                            $QueryClienteInfo = "SELECT A.SALDO_VENCIDO, A.SALDO_X_VENCER, A.SALDO_CXC, B.LIMITE_CREDITO,B.ESTATUS,A.CLIENTE_ID,A.SALDO_VENCIDO_PER1,A.SALDO_VENCIDO_PER2, A.SALDO_VENCIDO_PER3, B.Nombre, A.SALDO_X_VENCER_PER1, A.SALDO_X_VENCER_PER2, A.SALDO_X_VENCER_PER3,A.SALDO_X_VENCER,    
                                D.CLAVE_CLIENTE, E.NOMBRE
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
                                        $estatus = "Activo";
                                    } else if ($RowVencimiento->ESTATUS == "B") {
                                        $estatus = "Inactivo";
                                    } else if ($RowVencimiento->ESTATUS == "C") {
                                        $estatus = "Suspensión de credito";
                                    } else {
                                        $estatus = "Suspensión de ventas";
                                    }
                                    ?>
                                            <tr>
                                                <td><?php echo $RowVencimiento->CLAVE_CLIENTE ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE ?></td>
                                                <td><?php echo $RowVencimiento->SALDO_CXC ?></td>
                                                <td><?php echo $RowVencimiento->SALDO_X_VENCER ?></td>
                                                <?php if ($_POST['Saldo2'] == 0 || $_POST['Saldo2'] == -1) echo "<td>$RowVencimiento->SALDO_X_VENCER_PER1 </td>"; ?>
                                                <?php if ($_POST['Saldo2'] == 30 || $_POST['Saldo2'] == -1) echo "<td>$RowVencimiento->SALDO_X_VENCER_PER2 </td>"; ?>
                                                <td><?php echo $RowVencimiento->SALDO_VENCIDO ?></td>
                                                <?php if ($_POST['Saldo'] == 0 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER1 </td>"; ?>
                                                <?php if ($_POST['Saldo'] == 30 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER2 </td>"; ?>
                                                <?php if ($_POST['Saldo'] == 60 || $_POST['Saldo'] == -1) echo "<td>$SALDO_VENCIDO_PER3 </td>"; ?>
                                                <td><?php echo $estatus ?></td>
                                                <td><?php echo "-" ?></td>
                                                <td><?php echo $RowVencimiento->NOMBRE_01 ?></td>
                                                <td><?php echo "-" ?></td>
                                                <td><?php echo "-" ?></td>
                                                <td><?php echo $RowVencimiento->LIMITE_CREDITO ?></td>


                                            </tr>
                                        <?php
                                        }  
                                        }
                                    }
                                }
                                ?>

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        <?php
        }
    }
}


?>