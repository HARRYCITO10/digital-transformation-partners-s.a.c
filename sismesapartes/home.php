<?php
include('templates/template.php');  
include("conexion.php");


$sentencia = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM expedientes WHERE estado = 'pendiente'");
$sentencia->execute();
$pendientes = $sentencia->fetchColumn();

$sentencia = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM expedientes WHERE estado = 'en tramite'");
$sentencia->execute();
$tramites = $sentencia->fetchColumn();

$sentencia = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM expedientes WHERE estado = 'atendido'");
$sentencia->execute();
$atendidos = $sentencia->fetchColumn();


$sentencia = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM expedientes WHERE estado = 'denegado'");
$sentencia->execute();
$denegados = $sentencia->fetchColumn();

?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i>

                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pendientes</span>
                            <span class="info-box-number">
                                <?php echo $pendientes;   ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-sync"></i>

                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">En trámites</span>
                            <span class="info-box-number"> <?php echo $tramites;   ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-check-square"></i>

                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Atendidos</span>
                            <span class="info-box-number"><?php echo $atendidos;   ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i>

                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Denegados</span>
                            <span class="info-box-number"><?php echo $denegados;   ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>


            <!-- /.row -->


            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
</div>

<?php include('templates/footer.php');  ?>
<!-- /.content -->