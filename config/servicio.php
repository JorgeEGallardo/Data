<?php 
 $ruta="";
  $ar=fopen("../config/Conexion.ini","r") or
    die("Copie el archivo Conexion.ini que se genera desde .. a la carpeta donde se encuentra la p&aacute;gina web.");
  while (!feof($ar))
  {
    $linea=fgets($ar);
    $lineasalto=nl2br($linea);
    $ruta=$lineasalto;
  }
  fclose($ar);
  
  $READINI = parse_ini_file('Conexion.ini', 'CONEXION');
  $usuariodini = $READINI['CONEXION']['Usuario'];
  $passwddini = $READINI['CONEXION']['PASSWD'];
  $servicedini =  $READINI['CONEXION']['Servidor'];
  $rutadini = $READINI['CONEXION']['Datos'];
  $empresadiniC = $READINI['CONEXION']['Empresa'];
  $empresadini =explode( ",", $empresadiniC); 
  $empresagrupo = array();
  $grupoAguila = array();
  array_push($grupoAguila, 0);
  array_push($grupoAguila, 1);
  array_push($empresagrupo, $grupoAguila);
$baseencode = str_replace('igual', '=', $passwddini);
$basedecode = base64_decode($baseencode);


//$cadena_user = "StrConexion := '\"".$usuariodini."\" \"".$basedecode."\" \"".$servicedini.":".$rutadini.$empresadini."\"';";



  ?>

