<div class="modal fade" id="ModalCompras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Compras por periodo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" target="_blank" action="get/m.php" id="formVentas">

                <div class="modal-body">

                    <?php include('form/databases.php');?>
                    <div class="input-group">
                        <input class="form-control mydatepicker" type="date" name="finicial"
                            placeholder="Fecha inicial">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="form-control mydatepicker" type="date" name="ffinal" placeholder="Fecha final">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                </form>
      
      <div class="modal-footer">
      <button type="button" onClick="consulta('compras','formVentas');" class="btn btn-success" data-dismiss="modal">Exival empresa</button><br>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>

    </div>
</div>
</div>  