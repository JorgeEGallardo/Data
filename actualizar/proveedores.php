<?PHP
$y = date("y");
$Fechain = "20$y-01-01";
$FechaFin = "20$y-12-31";
include('../config/servicio.php');
for ($i=0; $i < 1; $i++) { 
    //--------------------------------//
//-----------Facturas-------------//
$conn=ibase_connect($servicedini.":".$rutadini.$empresadini[0],$usuariodini, $basedecode);	
$TotalRec=0;
$QueryProv = "SELECT DISTINCT PROVEEDOR_ID FROM proveedores;";
$Proveedores = ibase_query($conn, $QueryProv);
while ($RowProv = ibase_fetch_object($Proveedores)) {
    $QueryImportes = "SELECT SALDO_CXP,SALDO_ANTICIPOS FROM ORSP_CP_ANTSAL_PROV($RowProv->PROVEEDOR_ID,'$Fechain','$FechaFin',30,'N');";
    $Importes = ibase_query($conn, $QueryImportes);
    while ($RowImportes = ibase_fetch_object($Importes)) {
     $TotalRec+=$RowImportes->SALDO_CXP;   
    }
}


echo "Res : ".$TotalRec;
//-----------------------//

}