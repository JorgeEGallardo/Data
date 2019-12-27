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
$tot4 = 0;
$QuerySelectGrupos = "SELECT GRUPO_LINEA_ID, Nombre
from GRUPOS_LINEAS;"; 
$QueryGrupo=ibase_query($conn,$QuerySelectGrupos);
if (!$QueryGrupo)
{
echo "no se puede mostrar datos desde la consulta2: $Query1!";
exit;
}
$temp=$bases[$i];
$limp=str_replace(".FDB", "", $empresadini[$temp]);
echo "<h6 class='text-success'>Datos de $limp</h6>";
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
while ($RowQGrupo = ibase_fetch_object ($QueryGrupo)) 
{ 
    $QuerySelectLineas = "SELECT LINEA_ARTICULO_ID,Nombre
    from lineas_articulos where GRUPO_LINEA_ID = $RowQGrupo->GRUPO_LINEA_ID;";
$Query1=ibase_query($conn,$QuerySelectLineas);
if (!$Query1)
{
echo "no se puede mostrar datos desde la consulta2: $Query1!";
exit;
}

$tot2=0;


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
    $QuerySelect= "select * from EXIVAL_ART($RowQ->ARTICULO_ID,0 ,'".date("Y-m-d")."','S') ;";
    $Query=ibase_query($conn,$QuerySelect);
    if (!$Query)
    {
    echo "no se puede mostrar datos desde la consulta2: $Query!";
    exit;
    }

    
while ($RowQ = ibase_fetch_object ($Query)) 
{
  
$TOT += $RowQ->VALOR_TOTAL; 
}
$tot2 += $TOT;
$TOT = 0;
}

}

$count++;
echo '<tr><td>';
echo "$count</td><td>".$RowQGrupo -> NOMBRE."</TD><TD>".number_format($tot2,2)."</TD>";
echo '</td></tr>';

$tot4 += $tot2;
$tot2 = 0;
}
array_push($total, $tot4);
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