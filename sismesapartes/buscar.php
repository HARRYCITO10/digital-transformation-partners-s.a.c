<?php

include('conexion.php');

$fecha = '';
$hora = '';
$remitente = '';
$tipo_doc = '';
$asunto = '';
$folio = '';
$num_doc = '';
$correo = '';
$telefono = '';
$num_expediente = '';
$estado = '';
$mostrarResultado = false;
$tramites = array();
if($_POST){

$num_expediente=$_POST['num_expediente'];
$cod_seguridad=$_POST['cod_seguridad'];

$sentencia=$conexion->prepare("SELECT * FROM expedientes WHERE num_expediente=:num_expediente AND cod_seguridad=:cod_seguridad");
$sentencia->bindParam(":num_expediente",$num_expediente);
$sentencia->bindParam(":cod_seguridad",$cod_seguridad);
$sentencia->execute();
$registro=$sentencia->fetch(PDO::FETCH_ASSOC);


if ($registro) {
    $fecha = $registro['fecha'];
    $hora = $registro['hora'];
    $remitente = $registro['remitente'];
    $tipo_doc = $registro['tipo_doc'];
    $asunto = $registro['asunto'];
    $folio = $registro['folio'];
    $num_doc = $registro['num_doc'];
    $correo = $registro['correo'];
    $telefono = $registro['telefono'];
    $num_expediente = $registro['num_expediente'];
    $estado = $registro['estado'];
    $mostrarResultado = true;



    $sentencia = $conexion->prepare("SELECT tramites.*, areas.nombre AS area FROM tramites INNER JOIN areas ON tramites.area = areas.id WHERE tramites.idexpediente = :idexpediente");
    $sentencia->bindParam(":idexpediente", $registro['id']);
    $sentencia->execute();
    $tramites = $sentencia->fetchAll(PDO::FETCH_ASSOC);

} else {
    
   echo ' <span></span>';
}



}



?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>buscar trámite</title>

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
                <h4> Buscar trámite</h4>
            </div>
            <div class="card-body">
                <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="search" name="num_expediente" class="form-control form-control"
                                    placeholder="Ingresar N° expediente">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="search" name="cod_seguridad" class="form-control form-control"
                                    placeholder="Ingresar código de seguridad">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-md btn-primary">
                                        <i class="fa fa-search"> Buscar</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </form>
                <?php if($mostrarResultado):   ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Fecha y hora:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $fecha.' '.$hora;   ?></p>
                        </div>

                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Remitente:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $remitente;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Tipo documento:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $tipo_doc;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Asunto:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $asunto;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Folios:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $folio;  ?></p>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>DNI/RUC:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $num_doc;  ?></p>
                        </div>

                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Correo:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $correo;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Teléfono:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $telefono;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>N° expediente:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $num_expediente;  ?></p>
                        </div>
                        <div class="mb-2">
                            <h5 class="d-inline"><strong>Estado:</strong></h5>
                            <p class="d-inline ml-2"><?php echo $estado;  ?></p>
                        </div>
                    </div>
               

                </div>


            </div>
            <div class="card-footer text-muted"> </div>
        </div>
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
                                <td><a href="public/respuestas/<?php echo $tramite['adjunto'];  ?>"
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
        <?php endif; ?>

    </main>










    <!-- jQuery -->
    <script src="templates/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="templates/dist/js/adminlte.min.js"></script>

</body>

</html>