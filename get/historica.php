<?php
$bd = $_POST["bd"];
$year = $_POST["year"];
include('../config/servicio.php');
$FechaLim = "$year-12-31";
$conn2 = ibase_connect($servicedini . ":" . $rutadini . "registro.FDB", $usuariodini, $basedecode);
$conn = ibase_connect($servicedini . ":" . $rutadini . "DASHBOARD.FDB", $usuariodini, $basedecode);

$Query = "SELECT VALOR, FECHA FROM EXIVAL WHERE BD = '$empresadini[$bd]';";
$Exec = ibase_query($conn, $Query);
$ExivalV = 0;
while ($row = ibase_fetch_object($Exec)) {
    $ExivalV = $row->VALOR;
    $ExivalF = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM Ventas WHERE BD = '$empresadini[$bd]';";
$Exec = ibase_query($conn, $Query);
$VentasV = 0;
while ($row = ibase_fetch_object($Exec)) {
    $VentasV = $row->VALOR;
    $VentasF = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM CXC WHERE BD = '$empresadini[$bd]';";
$Exec = ibase_query($conn, $Query);
$CXCV = 0;
while ($row = ibase_fetch_object($Exec)) {
    $CXCV = $row->VALOR;
    $CXCF = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM COMPRAS WHERE BD = '$empresadini[$bd]';";
$Exec = ibase_query($conn, $Query);
$ComprasV = 0;
while ($row = ibase_fetch_object($Exec)) {
    $ComprasV = $row->VALOR;
    $ComprasF = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM RECUPERACION WHERE BD = '$empresadini[$bd]';";
$Exec = ibase_query($conn, $Query);
$Rec = 0;
while ($row = ibase_fetch_object($Exec)) {
    $Rec = $row->VALOR;
    $RecF = $row->FECHA;
}


$Query = "SELECT VALOR, FECHA FROM EXIVAL WHERE BD = '$empresadini[$bd]' AND FECHA = '$FechaLim';";
$Exec = ibase_query($conn2, $Query);
$ExivalVH = 0;
$ExivalFH = date("Y-m-d");
while ($row = ibase_fetch_object($Exec)) {
    $ExivalVH = $row->VALOR;
    $ExivalFH = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM Ventas WHERE BD = '$empresadini[$bd]'  AND FECHA = '$FechaLim';";
$Exec = ibase_query($conn2, $Query);
$VentasVH = 0;
$VentasFH = date("Y-m-d");
while ($row = ibase_fetch_object($Exec)) {
    $VentasVH = $row->VALOR;
    $VentasFH = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM CXC WHERE BD = '$empresadini[$bd]' AND FECHA = '$FechaLim';";
$Exec = ibase_query($conn2, $Query);
$CXCVH = 0;
$CXCFH = date("Y-m-d");
while ($row = ibase_fetch_object($Exec)) {
    $CXCVH = $row->VALOR;
    $CXCFH = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM COMPRAS WHERE BD = '$empresadini[$bd]' AND FECHA = '$FechaLim';";
$Exec = ibase_query($conn2, $Query);
$ComprasVH = 0;
$ComprasFH = date("Y-m-d");
while ($row = ibase_fetch_object($Exec)) {
    $ComprasVH = $row->VALOR;
    $ComprasFH = $row->FECHA;
}
$Query = "SELECT VALOR, FECHA FROM RECUPERACION WHERE BD = '$empresadini[$bd]' AND FECHA = '$FechaLim';";
$Exec = ibase_query($conn2, $Query);
$RecH = 0;
$RECFH = date("Y-m-d");
while ($row = ibase_fetch_object($Exec)) {
    $RecH = $row->VALOR;
    $RecFH = $row->FECHA;
}
$Rec2 = $Rec / 2;

?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0"><?php echo str_replace(".FDB", "", $empresadini[$bd]); ?></h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Elemento</th>
                    <th scope="col">Valor actual</th>
                    <th scope="col">Fecha actual</th>
                    <th scope="col">Valor <?php echo $year;?></th>
                    <th scope="col">Fecha </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Inventario</td>
                    <td id="m1"><?php echo number_format($ExivalV, 2); ?></td>
                    <td><?php echo $ExivalF ?></td>
                    <td id="m1"><?php echo number_format($ExivalVH, 2); ?></td>
                    <td><?php echo $ExivalFH ?></td>
                </tr>
                <tr>
                    <td>Ventas a clientes</td>
                    <td id="m2"><?php echo number_format($VentasV, 2); ?></td>
                    <td><?php echo $VentasF ?></td>
                    <td id="m2"><?php echo number_format($VentasVH, 2); ?></td>
                    <td><?php echo $VentasFH ?></td>
                </tr>
                <tr>
                    <td>Cuentas por cobrar</td>
                    <td id="m3"><?php echo number_format($CXCV, 2); ?></td>
                    <td><?php echo $CXCF ?></td>
                    <td id="m3"><?php echo number_format($CXCVH, 2); ?></td>
                    <td><?php echo $CXCFH ?></td>
                </tr>

                <tr>
                    <td>Recuperacion de cartera</td>
                    <td id="m5"><?php echo number_format($Rec, 2); ?> </td>
                    <td><?php echo $RecF ?></td>
                    <td id="m5"><?php echo number_format($RecH, 2); ?> </td>
                    <td><?php echo $RecFH ?></td>
                </tr>
                <tr>
                    <td>Compras</td>
                    <td id="m4"><?php echo number_format($ComprasV, 2); ?></td>
                    <td><?php echo $ComprasF ?></td>
                    <td id="m4"><?php echo number_format($ComprasVH, 2); ?></td>
                    <td><?php echo $ComprasFH ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Recuperación por meses</h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mes</th>
                    <th scope="col">2016</th>
                    <th scope="col">2017</th>
                    <th scope="col">2018</th>
                    <th scope="col">2019</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($k = 1; $k <= 12; $k++) {
                    $mtemp = "";
                    if ($k < 10) {
                        $mtemp = "0" . $k;
                    } else {
                        $mtemp = $k;
                    }
                    $Query = "SELECT VALOR, FECHA FROM MESES WHERE BD = '$empresadini[$bd]'
            AND FECHA like '%-$mtemp%' order by FECHA;";
                    $Exec = ibase_query($conn, $Query);
                    $cont = 0;
                    $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    echo '<tr>';
                    echo "<td>" . $months[$k - 1] . "</td>";
                    while ($row = ibase_fetch_object($Exec)) {
                        $cont += $row->VALOR;
                        $VALOR = $row->VALOR;
                        $month = date("m", strtotime($row->FECHA));
                        $Fecha = $row->FECHA;
                        ?>
                        <td id="m4"><?php echo number_format($VALOR, 2); ?></td>
                        

                    <?PHP }
                echo '</tr>';
            } ?>

                <tr>
                    <td>
                        <?PHP echo "Actual"; ?>
                    </td>
                    <td id="m4"><?php echo number_format($Rec - $cont, 2); ?></td>
                    <td><?php echo
                            date("d-m-Y"); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>