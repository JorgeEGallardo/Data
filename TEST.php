<html>
    <body>
<?php
 include('config/servicio2.php');
 $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[0] . "", $usuariodini, $basedecode);
 $QueryArticulos = "SELECT DISTINCT ARTICULO_ID, NOMBRE FROM ARTICULOS";
 $Articulo = ibase_query($conn, $QueryArticulos);
 while ($RowQArticulo = ibase_fetch_object($Articulo)) {
     /*echo "<br>";
    $QueryULT = "SELECT * FROM GET_ULTCOM_ART($RowQArticulo->ARTICULO_ID)";
    $ULT = ibase_query($conn, $QueryULT);
    while ($RowQULT = ibase_fetch_object($ULT)) {
    //echo "<br>".$RowQArticulo->NOMBRE."<br>".$RowQULT->FECHA_ULTIMA_COMPRA."<br>".$RowQULT->COSTO_ULTIMA_COMPRA."<br>";
    }*/
   $QueryULT = "SELECT * FROM GET_FECHA_ULTVEN_PV($RowQArticulo->ARTICULO_ID,0,'2019-08-19','S')";
   $ULT = ibase_query($conn, $QueryULT);
   while ($RowQULT = ibase_fetch_object($ULT)) {
   echo "<br>".$RowQULT->FECHA."<br>";
   }
   echo "<br>";
}
 