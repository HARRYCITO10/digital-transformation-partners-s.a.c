<?php

$sentencia=$conexion->prepare("SELECT * FROM areas");
$sentencia->execute();
$areas=$sentencia->fetchAll(PDO::FETCH_ASSOC);



if ($_POST) {
   

    $expediente_id = $_POST['expediente_id'];
    $idarea_destino = $_POST['idarea'];

 
    $sentencia_actualizar = $conexion->prepare("UPDATE expedientes SET idarea_destino = :idarea, estado = 'en tramite' WHERE id = :expediente_id");
    $sentencia_actualizar->bindParam(':idarea', $idarea_destino);
    $sentencia_actualizar->bindParam(':expediente_id', $expediente_id);
    $sentencia_actualizar->execute();

    echo '<script>window.location.href = "index.php";</script>';

}



 ?>


<div class="modal fade" id="derivar<?php echo $expediente['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">DERIVAR EXPEDIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="expediente_id" value="<?php echo $expediente['id']; ?>">
                    <div class="mb-3">

                        <div class="mb-3">
                            <label for="idarea" class="form-label">Area destino</label>
                            <select class="form-control form-select form-select-sm" name="idarea" id="idarea">
                                <?php foreach($areas as $area) {  ?>
                                <option value="<?php echo $area['id'];?>"><?php echo $area['nombre']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Derivar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                    </div>
            </form>
        </div>
    </div>
</div>