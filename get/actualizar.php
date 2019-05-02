<?PHP
$y = date("y");
$Fechain = "20".$y."-01-01";
$FechaFin = "20".date("y-m-d");
include('../config/servicio.php');
for ($i=0; $i < count($empresadini) ; $i++) { 
//-----------------------//
    //EXIVAL
    $QueryCliente = "SELECT DISTINCT ARTICULO_ID FROM ARTICULOS;";
    $tot2=0;
            $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i]."",$usuariodini, $basedecode);
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
    $QuerySelect= "EXECUTE procedure CALC_EXIS_ARTALM($RowQCliente->ARTICULO_ID,372846 ,'".date("Y-m-d")."') ;";
    $QueryUltimaCompra ="SELECT COSTO_ULTIMA_COMPRA FROM GET_ULTCOM_ART($RowQCliente->ARTICULO_ID);";
    $Query=ibase_query($conn,$QuerySelect);
    $Query2=ibase_query($conn,$QueryUltimaCompra);
    if (!$Query)
    {
    echo "no se puede mostrar datos desde la consulta2: $Query!";
    exit;
    }
    $count =0;
    $TOT = 0;
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
    
    $tot2 += $TOT;
    $TOT = 0;
            }
    }
    $conn=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryExival = "INSERT INTO EXIVAL (VALOR, BD) VALUES ($tot2,'$empresadini[$i]');";  
$Exival = ibase_query($conn, $QueryExival);
//-----------------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	

$cont=0;
$QuerySelectClientes= "SELECT A.CLIENTE_ID FROM ORSP_LISTA_CLIENTES('N') A 
WHERE A.ESTATUS <> 'B';";
$QueryClientes=ibase_query($conn,$QuerySelectClientes);
while ($RowQClientes = ibase_fetch_object($QueryClientes)) {
    $QuerySelectVentas ="SELECT B.FECHA AS FECHA_FIN_MES, B.VENTA_IMPORTE FROM ORSP_VE_VENTAS_CLI($RowQClientes->CLIENTE_ID,'$Fechain','$FechaFin','N','C','M') B;";
    $QueryVentas=ibase_query($conn,$QuerySelectVentas);
    while ($RowQVentas = ibase_fetch_object($QueryVentas)) {
    $venta = $RowQVentas->VENTA_IMPORTE;
    $cont+=$venta;
}
}
$conn=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryVentas = "INSERT INTO VENTAS (VALOR, BD) VALUES ($cont,'$empresadini[$i]');";  
$Ventas= ibase_query($conn, $QueryVentas);

}