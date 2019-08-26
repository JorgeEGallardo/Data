
<?php
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Reporte' . date("Y-m-d") . '.csv"');
$salida = fopen('php://output', 'w');
fputcsv($salida, array("Articulo","Descripcion","Existencia","Fecha compra","Costo compra","Fecha Venta"));
 include('config/servicio2.php');
 print_r($_POST);
 $conn = ibase_connect($servicedini . ":" . $rutadini . $empresadini[1] . "", $usuariodini, $basedecode);
 $QueryArticulos = "SELECT DISTINCT ARTICULO_ID, NOMBRE FROM ARTICULOS";
 $Articulo = ibase_query($conn, $QueryArticulos);
 while ($RowQArticulo = ibase_fetch_object($Articulo)) {
    $Ex="";
    $QueryExis ="select * from EXIVAL_ART($RowQArticulo->ARTICULO_ID,0 ,'2019-11-12','S');";
    $Exis= ibase_query($conn, $QueryExis);
    while ($RowqExis = ibase_fetch_object($Exis)) {
        $Ex = $RowqExis->EXISTENCIA;
        }
    $QueryULT = "SELECT A.DOCTO_VE_ID,A.ARTICULO_ID,B.FECHA
    FROM DOCTOS_VE_DET A 
    JOIN DOCTOS_VE B ON(A.DOCTO_VE_ID=B.DOCTO_VE_ID)
    WHERE ARTICULO_ID = $RowQArticulo->ARTICULO_ID
    AND ROL <> 'C' ORDER BY B.FECHA;";
    $ULT = ibase_query($conn, $QueryULT);
    $fecha="";
    while ($RowQULT = ibase_fetch_object($ULT)) {
    $fecha = $RowQULT->FECHA;
    }

    $QueryULT = "SELECT A.DOCTO_PV_ID,A.ARTICULO_ID,B.FECHA
    FROM DOCTOS_PV_DET A 
    JOIN DOCTOS_PV B ON(A.DOCTO_PV_ID=B.DOCTO_PV_ID)
    WHERE ARTICULO_ID = $RowQArticulo->ARTICULO_ID
    AND ROL <> 'C' ORDER BY B.FECHA;";
    $ULT = ibase_query($conn, $QueryULT);
    $fechaPV="";
    while ($RowQULT = ibase_fetch_object($ULT)) {
    $fechaPV = $RowQULT->FECHA;
    }

    if($fecha<$fechaPV){
        $fecha=$fechaPV;
    }
    $QueryULT = "SELECT * FROM GET_ULTCOM_ART($RowQArticulo->ARTICULO_ID)";
    $ULT = ibase_query($conn, $QueryULT);
    while ($RowQULT = ibase_fetch_object($ULT)) {
        fputcsv($salida, array($RowQArticulo->ARTICULO_ID,$RowQArticulo->NOMBRE,$Ex,$RowQULT->FECHA_ULTIMA_COMPRA,$RowQULT->COSTO_ULTIMA_COMPRA,$fecha));
    }
    /*
    SELECT A.DOCTO_VE_ID,A.ARTICULO_ID,B.FECHA
    FROM DOCTOS_VE_DET A 
    JOIN DOCTOS_VE B ON(A.DOCTO_VE_ID=B.DOCTO_VE_ID)
    WHERE ARTICULO_ID = 12194601
    AND ROL <> 'C' ORDER BY B.FECHA;*/
   }
 