<?php
    $empresas=array(); 
    $total=array(); 
    include('../config/servicio.php');
    $bases = $_POST["bases"];
    $in=false;
    $fecha = $_POST["ini"];
    $fechaini="'".$fecha."-01'";
    $fecha = date('Y-m-d', strtotime("+1 months", strtotime($fecha)));
    $fechafin="'".$fecha."'";
    for ($i=0; $i<count($bases);$i++) {
		$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$bases[$i]]."",$usuariodini, $basedecode);
		if (!$conn) 
    {
        echo "Error2";
        exit; 
    
    }else {
        $temp=$bases[$i];
        $limp=str_replace(".FDB", "", $empresadini[$temp]);


        $QueryClienteInfo = "SELECT DOCTOS_CC_1.DOCTO_CC_ID, 
        DOCTOS_CC_1.FECHA, DOCTOS_CC_1.FOLIO, 
        CONCEPTOS_CC_1.NOMBRE, 
        DOCTOS_CC_1.CLAVE_CLIENTE, 
        CLIENTES_1.NOMBRE NOMBRE_2, 
        IMPORTES_DOCTOS_CC_1.IMPORTE, 
        IMPORTES_DOCTOS_CC_1.IMPUESTO, 
        (IMPORTES_DOCTOS_CC_1.IMPORTE + IMPORTES_DOCTOS_CC_1.IMPUESTO) IMPORTES_DOCTOS_CC_1_IMP
        FROM DOCTOS_CC DOCTOS_CC_1
       INNER JOIN CONCEPTOS_CC CONCEPTOS_CC_1 ON 
        (CONCEPTOS_CC_1.CONCEPTO_CC_ID = DOCTOS_CC_1.CONCEPTO_CC_ID)
       INNER JOIN CLIENTES CLIENTES_1 ON 
      (CLIENTES_1.CLIENTE_ID = DOCTOS_CC_1.CLIENTE_ID)
       INNER JOIN IMPORTES_DOCTOS_CC IMPORTES_DOCTOS_CC_1 ON 
      (IMPORTES_DOCTOS_CC_1.DOCTO_CC_ID = DOCTOS_CC_1.DOCTO_CC_ID)
 WHERE 
       ( CONCEPTOS_CC_1.NOMBRE IN ('Venta','Venta en mostrador') )
       AND ( DOCTOS_CC_1.CANCELADO = 'N' ) 
       AND (DOCTOS_CC_1.FECHA < $fechafin)
       AND (DOCTOS_CC_1.FECHA >= $fechaini)
ORDER BY DOCTOS_CC_1.FECHA, DOCTOS_CC_1.FOLIO;";
        $Vencidos = ibase_query($conn, $QueryClienteInfo);
        
        if (!$Vencidos){
                echo "No se puede mostrar la consulta vencimientos: ".$QueryCredito."<br/>";
            }

        while ($RowVencimiento = ibase_fetch_object($Vencidos)){
            
      print_r($RowVencimiento);
    }
}



  
}


?>