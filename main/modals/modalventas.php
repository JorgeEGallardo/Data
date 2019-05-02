<div class="modal fade" id="ModalVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" target="_blank" action="get/ventasclienteperiodo.php" id="formVentas">

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
                    <input type="hidden" name="destacado" value="0">
                    <input type="hidden" name="limD" value="9999999">
                    <input type="hidden" name="limND" value="9999999">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Correr</button>
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
          </div>

    </div>
</div>
</div>