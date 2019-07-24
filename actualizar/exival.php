<?PHP
$name = "Exival".date("Ymd hhmmss").".txt"; 
$myfile = fopen($name , "w");
 
$y = date("y");
$Fechain = "20$y-01-01";
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
            $Porc = 0; 
            while ($RowQCliente = ibase_fetch_object ($QueryClienteF)) 
            { 
                $Porc++; 
                $txt = "Exival $Porc \n";
fwrite($myfile, $txt);
    $QuerySelect= "EXECUTE procedure CALC_EXIS_ARTALM($RowQCliente->ARTICULO_ID,372846 ,'$FechaFin') ;";
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
    print("Exival : ".$tot2);
    
    $conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
    $QueryExival = "INSERT INTO EXIVAL (VALOR, BD) VALUES ($tot2,'$empresadini[$i]');";  
    $Exival = ibase_query($conn2, $QueryExival);
//-----------------------//
}