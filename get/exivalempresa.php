<?php
if (!isset($_POST["bases"])){
echo "Error1";
exit;
}else{
    
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    for ($i=0; $i<count($bases);$i++) {
    $QueryCliente = "SELECT DISTINCT ARTICULO_ID FROM ARTICULOS;";
$tot2=0;
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn)
    {
        echo "Error3";
        exit; 
    
    }else {
        $QueryClienteF=ibase_query($conn,$QueryCliente);
        if (!$QueryClienteF)

        {
        echo "no se puede mostrar datos desde la consulta2: $QueryCliente!";
        exit;
        }  
        while ($RowQCliente = ibase_fetch_object ($QueryClienteF)) 
        { 
$QuerySelect= "select * from EXIVAL_ART($RowQCliente->ARTICULO_ID,0 ,'".date("Y-m-d")."','S') ;";
$Query=ibase_query($conn,$QuerySelect);
if (!$Query)
{
echo "no se puede mostrar datos desde la consulta2: $Query!";
exit;
}
$count =0;
$TOT = 0;
while ($RowQ = ibase_fetch_object ($Query)) 
{
  
$TOT +=  $RowQ->VALOR_TOTAL; 

}

$tot2 += $TOT;
$TOT = 0;
        }
}
array_push($total, $tot2);
array_push($empresas, $empresadini[$bases[$i]]);

}

}


$tot3= json_encode($total);

$names= json_encode($empresas);
?><div style="width:100%;height:20%">
<canvas id="myChart" width="400" height="100"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:<?php echo $names; ?>,
        datasets: [{
            label: 'Exival',
            data: <?php echo $tot3; ?>,
            backgroundColor: 
                'rgba(255, 99, 132, 0.2)',
            borderColor:           
                'rgba(54, 162, 235, 1)',
            
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
</script>