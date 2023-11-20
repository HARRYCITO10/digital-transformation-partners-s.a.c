<?php

include('../../conexion.php');

    if($_POST){
        $txtid=(isset($_POST['txtid'])?$_POST['txtid']:"");
        $nombre=(isset($_POST['nombre'])?$_POST['nombre']:"");
        $descripcion=(isset($_POST['descripcion'])?$_POST['descripcion']:"");
        $sentencia=$conexion->prepare("UPDATE areas SET nombre=:nombre,descripcion=:descripcion WHERE id=:txtid");
        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->bindParam(":txtid",$txtid);
        $sentencia->execute();
        echo '<script>window.location.href = "index.php";</script>';
        
        }


?>


<!-- Modal edit -->
<div class="modal fade" id="edit<?php echo $area['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR AREA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editar.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">

                        <input type="hidden" value="<?php echo $area['id'];?>" class="form-control" name="txtid" id="txtid"
                            aria-describedby="helpId">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $area['nombre'];?>"
                            id="nombre" aria-describedby="helpId">
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="<?php echo $area['descripcion'];?>"
                            id="descripcion" aria-describedby="helpId">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>