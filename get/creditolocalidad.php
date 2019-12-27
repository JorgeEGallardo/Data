<?php
if (!isset($_POST["bases"])){
echo "Error1";
exit;
}else{ 
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    $in=false;
    for ($i=0; $i<count($bases);$i++) {
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn)
    {
        echo "Error2";
        exit; 
    
    }else {
        $Zona = array();
        $Zona30 = array();
        $Zona60 = array();
        $CarteraV0 = array();
        $CarteraV30 = array();
        $CarteraV60 = array();
        $temp=$bases[$i];
$limp=str_replace(".FDB", "", $empresadini[$temp]);
echo "<h6 class='text-success'>Datos de $limp</h6>";
    $QuerySelectCliente = "SELECT DISTINCT C.ZONA_CLIENTE_ID
    FROM CLIENTES C"; 
$Query1=ibase_query($conn,$QuerySelectCliente);
if (!$Query1)
{
echo "no se puede mostrar datos de las zonas: $Query1!";
exit;
}
$fecha_ini = date('2000-01-01'); 
$fecha_fin = date("Y-m-d");
$tot =0;
$tot30 = 0; 
$tot60=0;
$control=false;
while ($RowQZona = ibase_fetch_object ($Query1)) 
{ 
    if ($RowQZona->ZONA_CLIENTE_ID != 0) {
    $QueryClientes="SELECT CLIENTE_ID 
    FROM CLIENTES
    WHERE ZONA_CLIENTE_ID=$RowQZona->ZONA_CLIENTE_ID;";
     
    $Cliente = ibase_query($conn, $QueryClientes);
    if (!$Cliente) {
        echo $QueryClientes;
    }else {
    while ($RowQCliente = ibase_fetch_object($Cliente)) {
        $QueryCredito = "SELECT CLIENTE_ID, SALDO_CXC, SALDO_XACR, SALDO_VENCIDO, SALDO_VENCIDO_PER1, SALDO_VENCIDO_PER2, SALDO_VENCIDO_PER3, SALDO_X_VENCER,
        SALDO_X_VENCER_PER1, SALDO_X_VENCER_PER2, SALDO_X_VENCER_PER3, FECHA_FIN_MES
        FROM ORSP_CL_ANTSAL_CLI_EX($RowQCliente->CLIENTE_ID, '".$fecha_ini."', '".$fecha_fin."', 30, 'N', 'S')";
        
        $Vencidos = ibase_query($conn, $QueryCredito);
        if (!$Vencidos){
                echo "No se puede mostrar la consulta vencimientos: ".$QueryCredito."<br/>";
                //exit;
            }

        while ($RowVencimiento = ibase_fetch_object($Vencidos)){
                $SALDO_VENCIDO_PER1 = $RowVencimiento->SALDO_VENCIDO_PER1;
                $SALDO_VENCIDO_PER2 = $RowVencimiento->SALDO_VENCIDO_PER2;
                $SALDO_VENCIDO_PER3 = $RowVencimiento->SALDO_VENCIDO_PER3;
            }
        $tot+=$SALDO_VENCIDO_PER1;
        $tot30+=$SALDO_VENCIDO_PER2; 
        $tot60+=$SALDO_VENCIDO_PER3;
    }
}
}   
    if ($control==false) {
        $control=TRUE;
    }else {
    $queryname="SELECT NOMBRE FROM ZONAS_CLIENTES WHERE ZONA_CLIENTE_ID=$RowQZona->ZONA_CLIENTE_ID";
    
    $zona = ibase_query($conn, $queryname);
    $m = "Desconocido";
    while ($QR = ibase_fetch_object($zona)) {
    $m=$QR->NOMBRE;
    }
    if ($tot>0){
        array_push($Zona, $m);
        
    array_push($CarteraV0, $tot);
    }
    if ($tot30>0){
        
    array_push($CarteraV30, $tot30);
        array_push($Zona30, $m);
    }
    if ($tot60>0){
        
    array_push($CarteraV60, $tot60);
        array_push($Zona60, $m);
    }
    $tot=0;
    $tot30=0;
    $tot60=0;
   
}}
$tot0= json_encode($CarteraV0);
$tot30= json_encode($CarteraV30);
$tot60= json_encode($CarteraV60);
$names= json_encode($Zona);
$names30= json_encode($Zona30);
$names60= json_encode($Zona60);

    }}}

?>
<button type="button" class="btn btn-success" onClick="btn1();">Menos de 30 días</button>
<button type="button" class="btn btn-success" onClick="btn2();">Entre 31 y 60 días</button>
<button type="button" class="btn btn-success" onClick="btn3();">Más de 60 días</button>
<div id="chart" style="width:100%;height:20%">
    <canvas id="myChart0" width="200" height="100"></canvas>
</div>


<script>

Chart.defaults.global.defaultFontSize =10;

function btn1(){
    
var ctx = document.getElementById("myChart0").getContext('2d');
$(ctx).empty();
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $names; ?>,
        datasets: [{
            label: '1 a 30 días',
            data: <?php echo $tot0; ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',

            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

}
function btn2(){
var ctx = document.getElementById("myChart0").getContext('2d');
ctx.clearRect(0, 0, 200, 100);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $names30; ?>,
        datasets: [{
            label: 'entre 30 y 60',
            data: <?php echo $tot30; ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(54, 235, 162, 1)',

            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
}
function btn3(){
var ctx = document.getElementById("myChart0").getContext('2d');
ctx.clearRect(0, 0, 200, 100);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $names60; ?>,
        datasets: [{
            label: 'Tornillos Aguila',
            data: <?php echo $tot60; ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(54, 235, 162, 1)',

            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
}
</script>