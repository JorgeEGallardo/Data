<div class="modal fade" id="Consulta3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="get/cartera.php" method="POST" id="formbase3">
      <div class="form-row">
      <div class="form-group col-md-4">
      <label for="inputState">Estatus</label>
      <select id="inputState" name="estatus" class="form-control">
        <option selected value="">Todos</option>
        <option value="A">Activo</option>
        <option value="B">Baja</option>
        <option value="C">Suspensión de crédito</option>
        <option value="V">Suspensión de ventas</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Forma de pago</label>
      <select id="inputState" name="Pago" class="form-control">
        <option selected value="">Todos</option>
        <option value="64983">Contado</option>
        <option value="64985">Credito</option>
        <option value="2377868">Contado temporal</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Zona</label>
      <select id="inputState" name="zona" class="form-control">
        <option selected value="">Todas</option>
    <?php include('config/servicio2.php');
    $conn=ibase_connect($servicedini.":".$rutadini.$empresadini[2]."",$usuariodini, $basedecode);
    $OptionQuery = "SELECT DISTINCT ZONA_CLIENTE_ID, NOMBRE FROM ZONAS_CLIENTES;";
    $Zonas =ibase_query($conn, $OptionQuery);
    while ($RowZonas = ibase_fetch_object($Zonas)) {
      echo "<option value=$RowZonas->ZONA_CLIENTE_ID>$RowZonas->NOMBRE</option>";
    }
    ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Saldo vencido</label>
      <select id="inputState" name="Saldo" class="form-control">
        <option selected value="-1">Todos</option>
        <option value="0">Menor a 31</option>
        <option value="30">31 a 60</option>
        <option value="60">mas de 60</option>
        <option value="100">Ninguno</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Saldo por vencer</label>
      <select id="inputState" name="Saldo2" class="form-control">
        <option selected value="-1">Todos</option>
        <option value="0">Menor a 31</option>
        <option value="30">31 a 60</option>
        <option value="60">mas de 60</option>
        <option value="100">Ninguno</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Vendedor</label>
      <select id="inputState" name="vend" class="form-control">
        <option selected value="">Todos</option>
    <?php
    $OptionQuery = "SELECT DISTINCT VENDEDOR_ID, NOMBRE FROM VENDEDORES;";
    $Zonas =ibase_query($conn, $OptionQuery);
    while ($RowZonas = ibase_fetch_object($Zonas)) {
      echo "<option value=$RowZonas->VENDEDOR_ID>$RowZonas->NOMBRE</option>";
    }
    ?>
      </select>
    </div>
    
    <input type="hidden" name="bases[]" value="2">
    
    </div>
      <div class="modal-footer">
      <button type="button" onClick="consulta('cartera2', 'formbase3');" class="btn btn-success" data-dismiss="modal">Vista previa</button><br>
      <button class="btn btn-success" >Descargar</button><br>
      </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
      
    </div>
  </div>
</div>
  </div>