<?php 
include("conexion.php"); 

$id = $_GET['id'];



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver cargo</title>

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
        <div class="card border">
            <div class="card-header bg-purple text-center">
                <h4> Imprimir Cargo</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-2">

                        </div>

                        <div class="col-sm-8">

                            <div class=" bg-light rounded-3">
                                <div class="container-fluid">
                                    <h3 class="display-5 fw-bold">Su documento se ha registrado exitosamente</h3>
                                    <p class="col-md-8 fs-4">Puede descargar su cargo en formato PDF, asimismo puede
                                        hacer su seguimiento de sus trámites
                                        a través de esta plataforma, simplemente ingresando el número de expediente y su
                                        código de seguridad.
                                    </p>
                                    <div class="text-center">
                                        <?php 
                                                echo '<a href="cargo.php?id=' . $id . '" class="btn btn-primary btn-lg" target="_blank">
                                                <i class="fa fa-print"></i> Imprimir cargo
                                                </a>';
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">


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