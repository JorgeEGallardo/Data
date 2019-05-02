<?php include('config\servicio2.php');
   $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[0]."",$usuariodini, $basedecode);
   $OptionQuery = "SELECT DISTINCT ZONA_CLIENTE_ID, NOMBRE FROM ZONAS_CLIENTES;";
   $Zonas =ibase_query($conn, $OptionQuery);
   while ($RowZonas = ibase_fetch_object($Zonas)) {
     echo "<option value=$RowZonas->ZONA_CLIENTE_ID>$RowZonas->NOMBRE</option>";
   }
    ?>