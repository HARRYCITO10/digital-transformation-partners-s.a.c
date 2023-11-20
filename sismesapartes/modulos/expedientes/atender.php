<?php
 include('../../templates/template.php'); 

include("../../conexion.php");

$id=$_GET['id'];

$sentencia=$conexion->prepare("SELECT * FROM expedientes WHERE id=:txtid");
$sentencia->bindParam(":txtid",$id);
$sentencia->execute();
$expediente=$sentencia->fetch(PDO::FETCH_ASSOC);




$idExpediente = $_GET['id'];

$sentencia = $conexion->prepare("SELECT tramites.*, areas.nombre AS area FROM tramites INNER JOIN areas ON tramites.area = areas.id WHERE tramites.idexpediente = :idExpediente");
$sentencia->bindParam(":idExpediente", $idExpediente);
$sentencia->execute();
$tramites = $sentencia->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST['cambiar_estado'])) {
    $nuevoEstado = $_POST['estado'];

    $sentencia_actualizar = $conexion->prepare("UPDATE expedientes SET estado = :nuevoEstado WHERE id = :idExpediente");
    $sentencia_actualizar->bindParam(":nuevoEstado", $nuevoEstado);
    $sentencia_actualizar->bindParam(":idExpediente", $idExpediente);
    $sentencia_actualizar->execute();
    echo '<script>window.location.href = "index.php";</script>';

}


?>




<div class="content-wrapper">
    <br>
    <div class="card">
        <div class="card-header bg-primary text-center">
            <h5 class=""> Detalles del expediente</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

                    <div>
                        <h5 class="d-inline">Fecha y hora:</h5>
                        <span class="d-inline"><?php echo $expediente['fecha'].' '. $expediente['hora']; ?></span>
                    </div>
                    <div>
                        <h5 class="d-inline">Remitente:</h5>
                        <span class="d-inline"><?php echo $expediente['remitente']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Tipo documento:</h5>
                        <span class="d-inline"><?php echo $expediente['tipo_doc']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Asunto:</h5>
                        <span class="d-inline"><?php echo $expediente['asunto']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Folio:</h5>
                        <span class="d-inline"><?php echo $expediente['folio']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Tipo persona:</h5>
                        <span class="d-inline"><?php echo $expediente['tipo_persona']; ?></span>
                    </div>

                </div>

                <div class="col-sm-6">

                    <div>
                        <h5 class="d-inline">DNI/RUC:</h5>
                        <span class="d-inline"><?php echo $expediente['num_doc']; ?></span>
                    </div>
                    <div>
                        <h5 class="d-inline">Correo:</h5>
                        <span class="d-inline"><?php echo $expediente['correo']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Teléfono:</h5>
                        <span class="d-inline"><?php echo $expediente['telefono']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Nro expediente:</h5>
                        <span class="d-inline"><?php echo $expediente['num_expediente']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Código de seguridad:</h5>
                        <span class="d-inline"><?php echo $expediente['cod_seguridad']; ?></span>
                    </div>

                    <div>
                        <h5 class="d-inline">Estado:</h5>
                        <span class="d-inline"><?php echo $expediente['estado']; ?></span>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#estado"><i class="fas fa-edit"></i>
                        </button>
                        <?php include('estado.php');  ?>
                    </div>

                </div>
            </div>


        </div>
        <div class="card-footer text-muted"> </div>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#respuesta">
            <i class="fas fa-plus"></i>Respuesta
        </button>
    </div> <br>
    <div class="card-primary">
        <div class="card-header text-center">
            Seguimiento de Trámite

        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Fecha/Hora</th>
                            <th>Descripción</th>
                            <th>Adjunto</th>
                            <th>Usuario</th>
                            <th>Area</th>

                        </tr>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach($tramites as $tramite) {  ?>
                        <tr class="">
                            <td><?php echo $i++  ?></td>
                            <td><?php echo $tramite['fecha'].' '.$tramite['hora'];  ?></td>
                            <td><textarea class="form-control border-0 form-control-plaintext d-flex" name="" id="" cols="30" rows="2" readonly><?php echo $tramite['descripcion'];  ?></textarea></td>

                            <td><a href="../../public/respuestas/<?php echo $tramite['adjunto'];  ?>"
                                    class="btn btn-success" target="_blank"><i class="fas fa-eye"></i></a></td>
                            <td><?php echo $tramite['usuario'];  ?></td>
                            <td><?php echo $tramite['area'];  ?></td>

                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>


        </div>

    </div>
    <?php include('respuestamodal.php');  ?>
</div>




<?php include('../../templates/footer.php'); ?>