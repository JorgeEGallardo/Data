<?php
if (true){
    
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[1]."",$usuariodini, $basedecode);
		if (!$conn)
    {
        echo "Error2";
        exit; 
    
    }else {
    $QuerySelectLineas = "SELECT NOMBRE_COMPLETO, SALARIO_DIARIO, SALARIO_INTEG, FECHA_INGRESO FROM EMPLEADOS WHERE FECHA_INGRESO <='2018-12-31';";
$Query1=ibase_query($conn,$QuerySelectLineas);
if (!$Query1)
{
echo "no se puede mostrar datos desde la consulta2: $Query1!";
exit;
}header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Tornillos2do.csv"');

$salida=fopen('php://output', 'w');
fputcsv($salida, array('Nombre','Salario Diario', 'Salario Integrado','Fecha de Ingreso'));
while ($RowQLin = ibase_fetch_object ($Query1)) 
{

fputcsv($salida, array($RowQLin->NOMBRE_COMPLETO, $RowQLin->SALARIO_DIARIO,$RowQLin->SALARIO_INTEG, $RowQLin->FECHA_INGRESO));
}
?>
<?php 
    }}?>