<?php
include("../../conexion.php");


if($_POST){

$idExpediente = $_GET['id'];
$descripcion = $_POST['descripcion'];
$adjunto=$_FILES['adjunto']['name'];

date_default_timezone_set('America/Lima');
$fecha=date('Y-m-d');
$hora=date('H:i:s');


$nombreUsuario = "";
$usuario = $_SESSION['usuario']; 
$sentenciaUsuario = $conexion->prepare("SELECT nombres, idarea FROM usuarios WHERE usuario = :usuario");
$sentenciaUsuario->bindParam(":usuario", $usuario);
$sentenciaUsuario->execute();

if ($row = $sentenciaUsuario->fetch(PDO::FETCH_ASSOC)) {
    $nombreUsuario = $row['nombres'];
    $idArea = $row['idarea'];
}


$sentencia = $conexion->prepare("INSERT INTO tramites (idexpediente,fecha,hora,descripcion,adjunto,usuario,area) VALUES (:idExpediente,:fecha,:hora,:descripcion,:adjunto,:usuario,:area)");
$sentencia->bindParam(":idExpediente", $idExpediente);
$sentencia->bindParam(":fecha",$fecha);
$sentencia->bindParam(":hora",$hora);
$sentencia->bindParam(":descripcion", $descripcion);
$sentencia->bindParam(":usuario", $nombreUsuario);
$sentencia->bindParam(":area", $idArea);


$fechas=new DateTime();

$nombreadjunto=($adjunto!='')?$fechas->getTimestamp()."_".$_FILES['adjunto']['name']:"";
$tmp_adjunto=$_FILES['adjunto']['tmp_name'];
if($tmp_adjunto!=''){
  move_uploaded_file($tmp_adjunto,"../../public/respuestas/".$nombreadjunto);
}

$sentencia->bindParam(":adjunto",$nombreadjunto);
$sentencia->execute();

echo '<script>window.location.href = "index.php";</script>';

}
?>


<!-- Modal create -->
<div class="modal fade" id="respuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">RESPUESTA AL TRÁMITE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">


                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30"
                            rows="2"></textarea>

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Adjunto</label>
                        <input type="file" class="form-control" name="adjunto" id="adjunto" aria-describedby="helpId">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>













