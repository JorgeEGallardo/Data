<div class="modal fade" id="ModalArticulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Análisis de árticulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" target="_blank" action="get/articulos.php" id="formVentas">

                <div class="modal-body">

                    <?php include('form/databases.php');?>
                   
                <div class="modal-footer">
                    <button class="btn btn-success">Correr</button>
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
          </div>

    </div>
</div>
</div>  