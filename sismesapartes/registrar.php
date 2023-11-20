<?php 
include("conexion.php"); 


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
  move_uploaded_file($tmp_archivo,"public/expedientes/".$nombrearchivo);
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

$id = $conexion->lastInsertId();
header("Location: ver.php?id=$id");
exit;

 }

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>registrar trámite</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="templates/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="templates/dist/css/adminlte.min.css">
</head>

<body>


    <nav class="navbar navbar-expand-sm navbar-dark navbar-navy fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto">
                <!-- Agregado "mx-auto" para centrar los elementos -->
                <li class="nav-item active mr-5">
                    <a class="nav-link d-flex align-items-center" href="index.php">
                        <i class="fas fa-folder-open fa-2x mr-2"></i>
                        <h3 class="m-0">MESA DE PARTES VIRTUAL</h3>
                    </a>
                </li>

            </ul>
        </div>
    </nav>


    <main role="main" class="container">
        <br><br><br><br>
        <div class="card border border-info">
            <div class="card-header bg-purple text-center">
                <h4> Registrar trámite</h4>
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
                                <input type="text" class="form-control" name="folio" id="folio"
                                    aria-describedby="helpId" placeholder="Nro folios" required>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Asunto</label>
                                <input type="text" class="form-control" name="asunto" id="asunto"
                                    aria-describedby="helpId" placeholder="Ingresa asunto" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Archivo</label>
                                <input type="file" class="form-control" name="archivo" id="archivo"
                                    aria-describedby="helpId" required>
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
                                    aria-describedby="helpId" placeholder="Ingresar correo">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono"
                                    aria-describedby="helpId" placeholder="Ingresar telefono">
                            </div>

                            <button type="submit" class="btn btn-info">Registrar</button>
                            <a href="index.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer text-muted"> </div>
        </div>

    </main>


    <!-- jQuery -->
    <script src="templates/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="templates/dist/js/adminlte.min.js"></script>

</body>

</html>