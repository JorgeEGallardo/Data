<div class="modal fade" id="ModalExival2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exival</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" id="formcred21">
<?php include('form/databases.php');?>
</form>
      </div>
      <div class="modal-footer">
      <button type="button" onClick="consulta('exivallinea','formcred21');" class="btn btn-success" data-dismiss="modal">Exival con línea de articulos</button><br>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
     
    </div>
  </div>
</div>