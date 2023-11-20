<!-- Modal create -->
<div class="modal fade" id="estado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">CAMBIAR ESTADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">


                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Estados</label>
                        <select name="estado" id="estado" class="form-control">
                            <option >atendido</option>
                            <option>denegado</option>
                        </select>

                    </div>
   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="cambiar_estado">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>