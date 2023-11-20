<?php 
include('../../templates/template.php');
include("../../conexion.php"); 


if ($_POST) {

$remitente=(isset($_POST['remitente'])?$_POST['remitente']:"");
$tipo_doc=(isset($_POST['tipo_doc'])?$_POST['tipo_doc']:"");
$folio=(isset($_POST['folio'])?$_POST['folio']:"");
$asunto=(isset($_POST['asunto'])?$_POST['asunto']:"");
$archivo=(isset($_FILES['archivo']['name'])?$_FILES['archivo']['name']:"");
$tipo_persona=(isset($_POST['tipo_persona'])?$_POST['tipo_persona']:"");
$num_doc=(isset($_POST['num_doc'])?$_POST['num_doc']:"");
$correo=(isset($_POST['correo'])?$_POST['correo']:"");
$telefono=(isset($_POST['telefono'])?$_POST['telefono']:"");

date_default_timezone_set('America/Lima');
$fecha=date('Y-m-d');
$hora=date('H:i:s');

    $sentencia = $conexion->prepare("SELECT MAX(num_expediente) AS max_num FROM expedientes");
    $sentencia->execute();
    $result = $sentencia->fetch(PDO::FETCH_ASSOC);
    $ultimoNumero = $result['max_num'];

    $nuevoNumero = str_pad($ultimoNumero + 1, 5, '0', STR_PAD_LEFT);

    $codigoSeguridad = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

    $estado="pendiente";

$sentencia=$conexion->prepare("INSERT INTO expedientes(id,fecha,hora,remitente,tipo_doc,folio,asunto,archivo,
tipo_persona,num_doc,correo,telefono,num_expediente,cod_seguridad,estado) 
VALUES(null,:fecha,:hora,:remitente,:tipo_doc,:folio,:asunto,:archivo,:tipo_persona,:num_doc,:correo,:telefono,:num_expediente,:cod_seguridad,:estado)");
$sentencia->bindParam(":fecha",$fecha);
$sentencia->bindParam(":hora",$hora);
$sentencia->bindParam(":remitente",$remitente);
$sentencia->bindParam(":tipo_doc",$tipo_doc);
$sentencia->bindParam(":folio",$folio);
$sentencia->bindParam(":asunto",$asunto);



$fechas=new DateTime();

$nombrearchivo=($archivo!='')?$fechas->getTimestamp()."_".$_FILES['archivo']['name']:"";
$tmp_archivo=$_FILES['archivo']['tmp_name'];
if($tmp_archivo!=''){
  move_uploaded_file($tmp_archivo,"../../public/expedientes/".$nombrearchivo);
}

$sentencia->bindParam(":archivo",$nombrearchivo);
$sentencia->bindParam(":tipo_persona",$tipo_persona);
$sentencia->bindParam(":num_doc",$num_doc);
$sentencia->bindParam(":correo",$correo);
$sentencia->bindParam(":telefono",$telefono);
$sentencia->bindParam(":num_expediente",$nuevoNumero);
$sentencia->bindParam(":cod_seguridad",$codigoSeguridad);
$sentencia->bindParam(":estado",$estado);
$sentencia->execute();
echo '<script>window.location.href = "index.php";</script>';

}


?>


<div class="content-wrapper">
    <br>
    <div class="card">
        <div class="card-header">
            <h5> Datos del expediente</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Remitente</label>
                            <input type="text" class="form-control" name="remitente" id="remitente"
                                aria-describedby="helpId" placeholder="Nombre o razon social" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Tipo documento</label>
                            <input type="text" class="form-control" name="tipo_doc" id="tipo_doc"
                                aria-describedby="helpId" placeholder="ej. Carta, oficio, etc" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Folios</label>
                            <input type="text" class="form-control" name="folio" id="folio" aria-describedby="helpId"
                                placeholder="Nro folios" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Asunto</label>
                            <input type="text" class="form-control" name="asunto" id="asunto" aria-describedby="helpId"
                                placeholder="Ingresa asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Archivo</label>
                            <input type="file" class="form-control" name="archivo" id="archivo" aria-describedby="helpId"
                               required >
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Tipo persona</label>
                            <select name="tipo_persona" id="tipo_persona" class="form-control" required>
                                <option>Natural</option>
                                <option>Juridica</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">DNI/RUC</label>
                            <input type="text" class="form-control" name="num_doc" id="num_doc"
                                aria-describedby="helpId" placeholder="Ingresar ruc o dni" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Correo</label>
                            <input type="text" class="form-control" name="correo" id="correo"
                                aria-describedby="helpId" placeholder="Ingresar correo" required>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono"
                                aria-describedby="helpId" placeholder="Ingresar telefono" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="index.php" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer text-muted"> </div>
    </div>
</div>




<?php include('../../templates/footer.php'); ?>