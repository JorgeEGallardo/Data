<?php 
$bd = $_POST["bd"];
include('../config/servicio.php');
$conn=ibase_connect($servicedini.":".$rutadini."SEMANAL.FDB",$usuariodini, $basedecode);	
$Query = "SELECT VALOR, FECHA FROM EXIVAL WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$ExivalV =0;
$ExivalF="";
while ($row = ibase_fetch_object($Exec)) {
$ExivalV = $row->VALOR;
$ExivalF = $row->FECHA;
} 
$Query = "SELECT VALOR, FECHA FROM Ventas WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$VentasV =0;
$VentasF = "";
while ($row = ibase_fetch_object($Exec)) {
$VentasV = $row->VALOR;
$VentasF = $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM CXC WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$CXCV =0;
$CXCf ="";
while ($row = ibase_fetch_object($Exec)) {
$CXCV = $row->VALOR;
$CXCF = $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM COMPRAS WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$ComprasV =0;
$ComprasF="";
while ($row = ibase_fetch_object($Exec)) {
$ComprasV = $row->VALOR;
$ComprasF = $row->FECHA;
} 
 $Query = "SELECT VALOR, FECHA FROM RECUPERACION WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$Rec =0;
$RECF="";
while ($row = ibase_fetch_object($Exec)) {
$Rec= $row->VALOR;
$RecF= $row->FECHA;
}  
$Query = "SELECT VALOR, FECHA FROM PROVEEDORES WHERE BD = '$empresadini[$bd]';";  
$Exec = ibase_query($conn, $Query);
$Prov =0;
$ProvF="";
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
            <h5 class="card-title m-b-0">Resumen semanal </h5>
        </div>
        
        <canvas id="myChart" width="400" height="400"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: [{
    x: 10,
    y: 20
}, {
    x: 15,
    y: 10
}],
    options: {
        scales: {
            yAxes: [{
                stacked: true
            }]
        }
    }
});
</script>
    </div>
</div>