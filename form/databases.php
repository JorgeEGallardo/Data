<?php 
//Aqui se imprimirán las bases de datos y sus checkbox  
include('config/servicio2.php');
echo '<div class="form-check">';
echo '<table class="table">';
echo '<tr>';
$lim =3; 
for($i=0; $i < count($empresadini);$i++){
    $limp=str_replace(".FDB","",$empresadini[$i]);
?>
<td>
<input type="checkbox" value="<?php echo $i; ?>" name="bases[]"> 
<label for="bases[]"><?php echo $limp;?></label>
</td> 
<?php if(($i+1)%$lim==0){
echo '</tr><tr>';
}?>
<?php
}
echo '</table>';
echo '</div>';

?>