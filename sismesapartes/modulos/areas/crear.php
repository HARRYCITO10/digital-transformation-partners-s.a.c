<?php
if($_POST){

$nombre=(isset($_POST['nombre'])?$_POST['nombre']:"");
$descripcion=(isset($_POST['descripcion'])?$_POST['descripcion']:"");
$sentencia=$conexion->prepare("INSERT INTO areas(id,nombre,descripcion) VALUES(null,:nombre,:descripcion)");
$sentencia->bindParam(":nombre",$nombre);
$sentencia->bindParam(":descripcion",$descripcion);
$sentencia->execute();
echo '<script>window.location.href = "index.php";</script>';

}
?>
    <!-- Modal create -->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">AGREGAR AREA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                aria-describedby="helpId" placeholder="Nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion"
                                aria-describedby="helpId" placeholder="Descripción">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>