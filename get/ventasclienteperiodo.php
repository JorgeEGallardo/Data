

<?php   
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="ReporteDeVentas.csv"');

class ventaMes { 
        
    var $nombre, $email, $clave, $precios, $total, $destacado, $vendedor, $zona;
    public function ventaMes( $clavep, $nombrep, $emailp, $preciosp, $totalp, $destacadop, $vendedorp,$zonap) { 
        $this->nombre = $nombrep; 
        $this->email = $emailp; 
        $this->precios = $preciosp; 
        $this->total = $totalp;
        $this->destacado = $destacadop;
        $this->vendedor = $vendedorp;
        $this->zona = $zonap;
        $this->clave = $clavep;
    } 
    
} 
function comparator($object1, $object2) { 
    return $object1->total < $object2->total; 
} 

include('../config/servicio.php');
if(!(isset($_POST["bases"]))){
    exit;
}
$bases = $_POST["bases"];

    for ($i=0; $i<count($bases);$i++) {
        $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn)
    {
        echo "Error3";
        exit; 
    
    }
    $PorDestacado=$_POST["destacado"]; 
    $LimiteDest = $_POST["limD"]; 
    $LimiteNDest = $_POST["limND"];
    $Fechain=$_POST["finicial"];
    $FechaFin=$_POST["ffinal"];
    $QuerySelectVentasH ="SELECT B.FECHA AS FECHA_FIN_MES FROM ORSP_VE_VENTAS_CLI(0,'$Fechain','$FechaFin','N','C','M') B;";
    $QueryVentasH=ibase_query($conn,$QuerySelectVentasH);
    
$salida=fopen('php://output', 'w');

        $temp=$bases[$i];
        $limp=str_replace(".FDB", "", $empresadini[$temp]);
        fputcsv($salida, array("Reporte: ".$limp));
        $encabezados = array("Clave","Cliente", "Email", "Zona", "Vendedor");
    while ($RowQVentasH = ibase_fetch_object($QueryVentasH)) {
    $Mes = $RowQVentasH->FECHA_FIN_MES;
    $Mes = date("M", strtotime($Mes));
    if ($Mes == "Jan"){
        $Mes="Enero";
    }else if ($Mes == "Feb"){
        $Mes = "Febrero";
    }else if ($Mes == "Feb"){
        $Mes = "Febrero";
    }else if ($Mes == "Mar"){
        $Mes = "Marzo";
    }else if ($Mes == "Apr"){
        $Mes = "Abril";
    }else if ($Mes == "May"){
        $Mes = "Mayo";
    }else if ($Mes == "Jun"){
        $Mes = "Junio";
    }else if ($Mes == "Jul"){
        $Mes = "Julio";
    }else if ($Mes == "Aug"){
        $Mes = "Agosto";
    }else if ($Mes == "Sep"){
        $Mes = "Septiembre";
    }else if ($Mes == "Oct"){
        $Mes = "Octubre";
    }else if ($Mes == "Nov"){
        $Mes = "Noviembre";
    }else if ($Mes == "Dec"){
        $Mes = "Diciembre";
    }
    array_push($encabezados, $Mes); 
    }
    array_push($encabezados, "Total");
    array_push($encabezados, "Destacado");
    fputcsv($salida, $encabezados);
    $arrayVxC=array();
        
    $QuerySelectClientes= "SELECT A.NOMBRE_CLIENTE,A.CLIENTE_ID, A.NOMBRE_ZONA, A.NOMBRE_VENDEDOR, A.CLAVE_CLIENTE FROM ORSP_LISTA_CLIENTES('S') A 
    WHERE A.ESTATUS <> 'B';";
    $QueryClientes=ibase_query($conn,$QuerySelectClientes);
    while ($RowQClientes = ibase_fetch_object($QueryClientes)) {
        $QuerySelectEmail = "SELECT EMAIL FROM  DIRS_CLIENTES WHERE CLIENTE_ID = $RowQClientes->CLIENTE_ID";
        $QueryEmail=ibase_query($conn,$QuerySelectEmail);
        $EMAIL = "";
        while ($RowQEmail = ibase_fetch_object($QueryEmail)) {
            $EMAIL = $RowQEmail->EMAIL;
        }
        //print("<tr>");
        $ClienteDestacado = TRUE; 
        $contaVenta=0; 
        $ventas = array();
        //print("<td>$RowQClientes->NOMBRE_CLIENTE</td>");
        $cont=0;
        $QuerySelectVentas ="SELECT B.FECHA AS FECHA_FIN_MES, B.VENTA_IMPORTE FROM ORSP_VE_VENTAS_CLI($RowQClientes->CLIENTE_ID,'$Fechain','$FechaFin','B','C','M') B;";
        $QueryVentas=ibase_query($conn,$QuerySelectVentas);
        while ($RowQVentas = ibase_fetch_object($QueryVentas)) {
        $venta = $RowQVentas->VENTA_IMPORTE;
        if ($venta<=0)
            $ClienteDestacado=FALSE;
        array_push($ventas, $venta);
        //echo "<td>$venta</td>";
        $cont+=$venta;
    }
    $cliente = new ventaMes($RowQClientes->CLAVE_CLIENTE, $RowQClientes->NOMBRE_CLIENTE, $EMAIL, $ventas, $cont, $ClienteDestacado, $RowQClientes->NOMBRE_VENDEDOR, $RowQClientes->NOMBRE_ZONA);
    array_push($arrayVxC, $cliente);
       
   // echo "<td>$cont</td>";
//print("</tr>");
}
$arrayEmails="";
$arrayEmails2="";
$contDestacado = 0; 
$contNDestacado = 0; 
usort($arrayVxC, 'comparator'); 
foreach ($arrayVxC as $valor) {
    $arrayVenta = array();
if ($valor->destacado == false and ($PorDestacado==0 or $PorDestacado==2)){
    $contNDestacado++;
    if ($contNDestacado<=$LimiteNDest){
        array_push($arrayVenta,$valor->clave);
        array_push($arrayVenta,$valor->nombre); 
        array_push($arrayVenta,$valor->email);
        array_push($arrayVenta,$valor->zona);
        array_push($arrayVenta,$valor->vendedor);  
    $arrayEmails2 =$arrayEmails2.$valor->email.";";   
    foreach ($valor->precios as $valor2) {
        array_push($arrayVenta,$valor2);
    }
    array_push($arrayVenta,$valor->total);
    array_push($arrayVenta,"No Destacado");
    
fputcsv($salida, $arrayVenta);
}
}
else {
    $contDestacado++;
    if ($contDestacado<=$LimiteDest and ($PorDestacado==0 or $PorDestacado==1)){
        array_push($arrayVenta,$valor->clave);
        array_push($arrayVenta,$valor->nombre); 
        array_push($arrayVenta,$valor->email);
        array_push($arrayVenta,$valor->zona);
        array_push($arrayVenta,$valor->vendedor);
    $arrayEmails= $arrayEmails.$valor->email.";"; 
    foreach ($valor->precios as $valor2) {
        array_push($arrayVenta,$valor2);
    }
    array_push($arrayVenta,$valor->total);
    array_push($arrayVenta,"Destacado");
    
fputcsv($salida, $arrayVenta);
   }
}

}
    }
    
fputcsv($salida, array("Destacados",$arrayEmails));
fputcsv($salida, array("No destacados",$arrayEmails2));
?>
