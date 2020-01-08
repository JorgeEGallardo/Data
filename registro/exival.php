<?PHP
$name = "Exival".date("Ymd hhmmss").".txt"; 
$myfile = fopen($name , "w");
for ($y = 2019; $y<=2019;$y++){
    $Fechain = "$y-01-01";
    $FechaFin = "$y-12-31";
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
    $TOT += $RowQ->VALOR_TOTAL; 
    }
    
    $tot2 += $TOT;
    $TOT = 0;
            }
    }
    print("Exival : ".$tot2);
    
    $conn=ibase_connect($servicedini.":".$rutadini."REGISTRO.FDB",$usuariodini, $basedecode);	
$QueryExival = "INSERT INTO EXIVAL (VALOR, BD, FECHA) VALUES ($tot2,'$empresadini[$i]', '$FechaFin');";  
$Exival = ibase_query($conn, $QueryExival);
//-----------------------//
}
}