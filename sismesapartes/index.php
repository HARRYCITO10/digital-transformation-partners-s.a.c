<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mesa de partes</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="templates/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="templates/dist/css/adminlte.min.css">

    <style>
    .card-img-top:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    </style>

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


                <li class="nav-item ml-5">
                    <a class="nav-link" href="login.php">
                        <h4><i class="fas fa-user"></i> Login</h4>

                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <main role="main" class="container">
        <br><br><br><br><br>
        <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="public/img/registro.png" alt="Title">
                    <div class="card-body">
                        <h4 class="card-title"><a href="registrar.php" class="fa fa-file-alt btn-lg"> Registrar
                                Trámite</a></h4>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="public/img/buscar.png" alt="Title">
                    <div class="card-body">
                        <h4 class="card-title"><a href="buscar.php" class="fa fa-search btn-lg"> Buscar Trámite</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">

            </div>
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