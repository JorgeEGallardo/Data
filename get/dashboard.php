<?php 
$bd = $_POST["bd"];
include('../config/servicio.php');
$conn=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$Query = "SELECT VALOR, FECHA FROM EXIVAL WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$ExivalV =0;
while ($row = ibase_fetch_object($Exec)) {
$ExivalV = $row->VALOR;
$ExivalF = $row->FECHA;
} 
$Query = "SELECT VALOR, FECHA FROM Ventas WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$VentasV =0;
while ($row = ibase_fetch_object($Exec)) {
$VentasV = $row->VALOR;
$VentasF = $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM CXC WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$CXCV =0;
while ($row = ibase_fetch_object($Exec)) {
$CXCV = $row->VALOR;
$CXCF = $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM COMPRAS WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$ComprasV =0;
while ($row = ibase_fetch_object($Exec)) {
$ComprasV = $row->VALOR;
$ComprasF = $row->FECHA;
} 
 $Query = "SELECT VALOR, FECHA FROM RECUPERACION WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$Rec =0;
while ($row = ibase_fetch_object($Exec)) {
$Rec= $row->VALOR;
$RecF= $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM PROVEEDORES WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$Prov =0;
while ($row = ibase_fetch_object($Exec)) {
$Prov= $row->VALOR;
$ProvF= $row->FECHA;
}  
$Rec2 = $Rec/2; 
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0"><?php echo str_replace(".FDB", "",$empresadini[$bd]);?></h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Elemento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Inventario</td>
                    <td id="m1"><?php echo number_format($ExivalV,2);?></td>
                    <td><?php echo $ExivalF?></td>
                </tr>
                <tr>
                    <td>Ventas a clientes</td>
                    <td id="m2"><?php echo number_format($VentasV,2);?></td>
                    <td><?php echo $VentasF?></td>
                </tr>
                <tr>
                    <td>Cuentas por cobrar</td>
                    <td id="m3"><?php echo number_format($CXCV,2);?></td>
                    <td><?php echo $CXCF?></td>
                </tr>

                <tr>
                    <td>Recuperacion de cartera</td>
                    <td id="m5"><?php echo number_format($Rec,2);?> </td>
                    <td><?php echo $RecF?></td>
                </tr>
                <tr>
                    <td>Compras</td>
                    <td id="m4"><?php echo number_format($ComprasV,2); ?></td>
                    <td><?php echo $ComprasF?></td>
                </tr>
                <tr>
                    <td>Proveedores</td>
                    <td id="m4"><?php echo number_format($Prov,2); ?></td>
                    <td><?php echo $ProvF?></td>
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
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $FF = date("Y")."-12-31";
            $FI = date("Y")."-01-01";
            $Query = "SELECT VALOR, FECHA FROM MESES WHERE BD = '$empresadini[$bd]'
            AND FECHA <='$FF' AND FECHA >='$FI' order by FECHA;";  
            $Exec = ibase_query($conn, $Query);
            $cont = 0; 
            while ($row = ibase_fetch_object($Exec)) {
            $cont += $row->VALOR; 
            $VALOR = $row->VALOR;
            $month = date("m",strtotime($row->FECHA));
            $Fecha = $row->FECHA;
            if($month=="01"){
                $month = "Enero";
            }elseif($month=="02"){
                $month = "Febrero";
            }elseif($month=="03"){
                $month = "Marzo";
            }elseif($month=="04"){
                $month = "Abril";
            }elseif($month=="05"){
                $month = "Mayo";
            }elseif($month=="06"){
                $month = "Junio";
            }elseif($month=="07"){
                $month = "Julio";
            }elseif($month=="08"){
                $month = "Agosto";
            }elseif($month=="09"){
                $month = "Septiembre";
            }elseif($month=="10"){
                $month = "Octubre";
            }elseif($month=="11"){
                $month = "Noviembre";
            }else {
                $month = "Diciembre";
            }
            ?>
                <tr>
                    <td><?PHP echo $month;?></td>
                    <td id="m4"><?php echo number_format($VALOR,2); ?></td>
                    <td><?php echo 
            $month = date("d-m-Y",strtotime($Fecha));;?></td>
                </tr>
            <?PHP } ?>
            
            <tr>
                    <td><?PHP echo "Actual";?></td>
                    <td id="m4"><?php echo number_format($Rec-$cont,2); ?></td>
                    <td><?php echo 
                    date("d-m-Y");?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>