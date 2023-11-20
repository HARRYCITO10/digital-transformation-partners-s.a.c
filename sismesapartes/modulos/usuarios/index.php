<?php
include('../../templates/template.php');
include("../../conexion.php");

$sentencia=$conexion->prepare("SELECT *,(SELECT nombre FROM areas WHERE
areas.id=usuarios.idarea limit 1) as area FROM usuarios");
$sentencia->execute();
$usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['id'])) {

$txtid=(isset($_GET['id'])? $_GET['id']:"");
$sentencia=$conexion->prepare("DELETE FROM usuarios WHERE id=:idtxt");
$sentencia->bindParam(":idtxt",$txtid);
$sentencia->execute();
echo '<script>window.location.href = "index.php";</script>';


    
}



if ($_SESSION['idarea'] != 3) {
    exit();
}
?>


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">usuarios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
            <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>

                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Area</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Contraseña</th>
                            <th>correo</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach($usuarios as $usuario) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $i++; ?></td>
                            <td><?php echo $usuario['nombres']; ?></td>
                            <td><?php echo $usuario['area'];  ?> </td>
                            <td><?php echo $usuario['usuario']; ?></td>
                            <td><?php echo $usuario['password']; ?></td>
                            <td><?php echo $usuario['correo']; ?></td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#edit<?php echo $usuario['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $usuario['id'];?>)"
                                    role="button"> <i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php include('editar.php'); ?>
                        <?php  }  ?>
                    </tbody>
                </table>
            </div>
            <?php include('crear.php'); ?>

        </div>

    </div>

</div>


<?php include('../../templates/footer.php'); ?>