<?php
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    $in=false;
    $fecha = $_POST["ini"];
    $fechaini="'2019-03-01'";
    $fecha = date('Y-m-d', strtotime("+1 months", strtotime($fecha)));
    $fechafin="'2019-03-31'";
    for ($i=0; $i<count($bases);$i++) {
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn) 
    {
        echo "Error2";
        exit; 
    
    }else {
        $temp=$bases[$i];
        $limp=str_replace(".FDB", "", $empresadini[$temp]);


   $QueryClienteInfo = "SELECT FECHA, FOLIO, CLAVE_CLIENTE, VENDEDOR_ID, IMPORTE_COBRO, TIPO_DOCTO, COND_PAGO_ID 
        FROM DOCTOS_VE WHERE FECHA < $fechafin AND FECHA > $fechaini ;";
    $QueryClienteInfo = "SELECT FECHA, FOLIO, CLAVE_CLIENTE, VENDEDOR_ID, IMPORTE_NETO, TIPO_DOCTO
   FROM DOCTOS_PV WHERE FECHA < $fechafin AND FECHA > $fechaini;";
         
        $Vencidos = ibase_query($conn, $QueryClienteInfo);
        
        if (!$Vencidos){
                echo "No se puede mostrar la consulta vencimientos: ".$QueryCredito."<br/>";
            }
$cont=0;
        while ($RowVencimiento = ibase_fetch_object($Vencidos)){
            print_r($RowVencimiento);
   
  
    }
    print($cont);
}



  
}


?>