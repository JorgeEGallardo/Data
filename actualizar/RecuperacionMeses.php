<?PHP
$name = "Recuperacion".date("Ymd hhmmss").".txt"; 
$myfile = fopen($name , "w");
include('../config/servicio.php');
$month = date("m"); 
$month -= 2; 
$Fechain =date("Y")."-$month-01";
$FechaFin= date("Y-m-t", strtotime($Fechain));  


for ($i=0; $i < count($empresadini) ; $i++) { 

    //--------------------------------//
//-----------Facturas-------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[$i],$usuariodini, $basedecode);	

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
AND (DOCTOS_CC_1.FECHA <= '$FechaFin')
AND (DOCTOS_CC_1.FECHA >= '$Fechain')
ORDER BY DOCTOS_CC_1.FECHA, DOCTOS_CC_1.FOLIO;";
$Vencidos = ibase_query($conn, $QueryClienteInfo);

if (!$Vencidos){
        echo "No se puede mostrar la consulta vencimientos: ".$QueryCredito."<br/>";
    }
$cont=0;
while ($RowVencimiento = ibase_fetch_object($Vencidos)){
    $cont += $RowVencimiento->IMPORTE + $RowVencimiento->IMPUESTO;
}
$conn2=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$Query = "INSERT INTO MESES (VALOR, BD, FECHA) VALUES ($cont,'$empresadini[$i]', '$FechaFin');";  
$CXC= ibase_query($conn2, $Query);
}

