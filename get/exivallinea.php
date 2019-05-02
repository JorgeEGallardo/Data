<?php
if (!isset($_POST["bases"])){
echo "Error1";
exit;
}else{
    ?>
    
<canvas id="myChart" width="400" height="100"></canvas>
    <?php
    
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    for ($i=0; $i<count($bases);$i++) {
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
        if (!$conn)
        {
            echo "Error2";
            exit; 
        
     }else {
         
$count=0; 
    $QuerySelectLineas = "SELECT LINEA_ARTICULO_ID,Nombre
    from lineas_articulos;";
$Query1=ibase_query($conn,$QuerySelectLineas);
if (!$Query1)
{
echo "no se puede mostrar datos desde la consulta2: $Query1!";
exit;
}
$temp=$bases[$i];
$limp=str_replace(".FDB", "", $empresadini[$temp]);
echo "<h6 class='text-success'>Datos de $limp</h6>";
$tot2=0;
echo '<table class="table table-bordered table-hover table-sm">';
?>
  <thead>
    <tr>
      <th scope="col" style="width:10%">#</th>
      <th scope="col">Linea</th>
      <th scope="col" style="width:10%">Valor total</th>    
    </tr>
  </thead>
  <tbody>
  <?php
  
while ($RowQLin = ibase_fetch_object ($Query1)) 
{ 
    $QueryCliente = "SELECT DISTINCT ARTICULO_ID FROM ARTICULOS WHERE LINEA_ARTICULO_ID='$RowQLin->LINEA_ARTICULO_ID';";
    $QueryC=ibase_query($conn,$QueryCliente);
if (!$QueryC)
{
echo "no se puede mostrar datos desde la consulta2: $QueryC!";
exit;
}
$TOT = 0; 
while ($RowQ = ibase_fetch_object ($QueryC)) 
{
    $QuerySelect= "EXECUTE procedure CALC_EXIS_ARTALM($RowQ->ARTICULO_ID,372846 ,'".date("Y-m-d")."') ;";
    $QueryUltimaCompra ="SELECT COSTO_ULTIMA_COMPRA FROM GET_ULTCOM_ART($RowQ->ARTICULO_ID);";
    $Query=ibase_query($conn,$QuerySelect);
    $Query2=ibase_query($conn,$QueryUltimaCompra);
    if (!$Query)
    {
    echo "no se puede mostrar datos desde la consulta2: $Query!";
    exit;
    }

    
while ($RowQ = ibase_fetch_object ($Query)) 
{
    while ($RowQ2 = ibase_fetch_object ($Query2)) 
    {
        $vt = $RowQ2 ->COSTO_ULTIMA_COMPRA;
    }	
$ex = $RowQ -> EXIS_UNID; 
if ( $vt < 0) {
       $vt=0; 
}
if ( $ex < 0) {
    $ex=0; 
}
$TOT +=  $vt *$ex; 
}
}
$count++;
echo '<tr><td>';
echo "$count</td><td>".$RowQLin -> NOMBRE."</TD><TD>".number_format($TOT,2)."</TD>";
echo '</td></tr>';

$tot2 += $TOT;
$TOT = 0;

}
array_push($total, $tot2);
array_push($empresas, $empresadini[$bases[$i]]);

}

echo '</table>';

}

}
$tot3= json_encode($total);

$names= json_encode($empresas);
?><div style="width:100%;height:20%">
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