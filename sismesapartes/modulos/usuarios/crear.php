<?php 
include('../../conexion.php');

$sentencia=$conexion->prepare("SELECT * FROM areas");
$sentencia->execute();
$areas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
$nombre=(isset($_POST['nombre'])?$_POST['nombre']:"");
$usuario=(isset($_POST['usuario'])?$_POST['usuario']:"");
$password=(isset($_POST['password'])?$_POST['password']:"");
$correo=(isset($_POST['correo'])?$_POST['correo']:"");
$idarea=(isset($_POST['idarea'])?$_POST['idarea']:"");
$sentencia=$conexion->prepare("INSERT INTO usuarios(id,nombres,usuario,password,correo,idarea) 
VALUES(null,:nombre,:usuario,:password,:correo,:idarea)");
$sentencia->bindParam(":nombre",$nombre);
$sentencia->bindParam(":usuario",$usuario);
$sentencia->bindParam(":password",$password);
$sentencia->bindParam(":correo",$correo);
$sentencia->bindParam(":idarea",$idarea);
$sentencia->execute();
echo '<script>window.location.href = "index.php";</script>';


}



?>


<!-- Modal create -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="crear.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"
                            aria-describedby="helpId" placeholder="Nombres" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nombre del usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario"
                            aria-describedby="helpId" placeholder="Nombre usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password"
                            aria-describedby="helpId" placeholder="contraseña" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
                            placeholder="Correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="idarea" class="form-label">Area</label>
                        <select class="form-control form-select form-select-sm" name="idarea" id="idarea" required>
                            <?php foreach($areas as $area) {  ?>
                            <option value="<?php echo $area['id'];?>"><?php echo $area['nombre']; ?></option>
                            <?php  } ?>
                        </select>
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