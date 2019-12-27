<?php
if (true){
    
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    $fechafin = $_POST["ffinal"];
    $fechaini = $_POST["finicial"];
    for ($i=0; $i<count($bases);$i++) {
        
$tot2=0;
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn)
    {
        echo "Error2";
        exit; 
    
    }else {
    $QuerySelectLineas = "SELECT FOLIO, FECHA, CLAVE_CLIENTE,TOTAL_IMPUESTOS, IMPORTE_NETO, FECHA_HORA_CANCELACION FROM DOCTOS_VE WHERE ESTATUS = 'C' AND TIPO_DOCTO = 'F' AND FECHA<='$fechafin' AND FECHA >= '$fechaini';";
$Query1=ibase_query($conn,$QuerySelectLineas);
if (!$Query1)
{
echo "no se puede mostrar datos desde la consulta2: $Query1!";
exit;
}header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Tornillos2do.csv"');

$salida=fopen('php://output', 'w');
fputcsv($salida, array('Folio','Fecha', 'Cliente','Importe','Impuestos','Fecha de cancelacion','Diferencia(Días)'));
while ($RowQLin = ibase_fetch_object ($Query1)) 
{
$cur = DateTime::CreateFromFormat('Y-m-d H:i:s', $RowQLin->FECHA_HORA_CANCELACION);
$prev = DateTime::CreateFromFormat('Y-m-d', $RowQLin->FECHA);

$days = $cur->diff($prev)->format('%a');
fputcsv($salida, array($RowQLin->FOLIO,$RowQLin->FECHA,$RowQLin->CLAVE_CLIENTE,$RowQLin->IMPORTE_NETO,$RowQLin->TOTAL_IMPUESTOS,$cur->format('Y-m-d'),$days));
}
?>
<?php 
    }}}?>