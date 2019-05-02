<div class="modal fade" id="ModalVentas2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <input required class="form-control mydatepicker" type="date" name="finicial"
                            placeholder="Fecha inicial">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="input-group">
                        <input required class="form-control mydatepicker" type="date" name="ffinal" placeholder="Fecha final">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <select required class="form-control" name="destacado" >
                    <option value="0">Todos</option>
                    <option value="1">Solo destacados</option>
                    <option value="2">Solo no destacados</option>
                    </select>
                    <label>Usuarios destacados</label>
                    <input required class="form-control" type="text" name="limD" value="10">
                    <label>Usuarios no destacados</label>
                    <input required class="form-control" type="text" name="limND" value="10">

                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="alert('Generando archivo');" class="btn btn-success">Correr</button>
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
          </div>

    </div>
</div>
</div>