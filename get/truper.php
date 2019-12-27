<?php
 header('Content-Type:text/csv; charset=latin1');
 header('Content-Disposition: attachment; filename="Reporte.csv"');
       
 $salida = fopen('php://output', 'w');
 
 fputcsv($salida, array("Reporte: "));
 fputcsv($salida, array("ID", "Nombre"));

include('../config/servicio.php');
$conn=ibase_connect($servicedini.":".$rutadini."AGUILA.FDB",$usuariodini, $basedecode);	
$Query = "select articulo_id, nombre from articulos where linea_Articulo_id = 12085551;";  
$Exec = ibase_query($conn, $Query);
while ($row = ibase_fetch_object($Exec)) {
    $valid  = false; 
    $clv = "";
    $Query2 = "select rol_clave_art_id, clave_articulo from claves_Articulos where articulo_id =".$row->ARTICULO_ID;  
    $Exec2= ibase_query($conn, $Query2);
    while ($row2 = ibase_fetch_object($Exec2)) {
        if($row2->ROL_CLAVE_ART_ID=="64560")
            $valid = true;
        if($row2->ROL_CLAVE_ART_ID=="17")
            $clv = $row2->CLAVE_ARTICULO;
    }
        if(!$valid)
        fputcsv($salida, array($row->ARTICULO_ID, $row->NOMBRE,$clv ));
         
} 