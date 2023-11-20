<?php  
include('../../templates/template.php'); 

include("../../conexion.php");

$sentencia=$conexion->prepare("SELECT * FROM areas");
$sentencia->execute();
$areas=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if(isset($_GET['id'])){

$txtid=(isset($_GET['id'])? $_GET['id']:"");
$sentencia=$conexion->prepare("DELETE FROM areas WHERE id=:idtxt");
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
                    <h1 class="m-0">Areas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">areas</li>
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;  ?>
                        <?php foreach($areas as $area)  {  ?>
                        <tr class="">
                            <td scope="row"><?php echo $i++;?></td>
                            <td><?php echo $area['nombre']; ?></td>
                            <td><?php echo $area['descripcion'];  ?></td>
                            <td>

                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#edit<?php echo $area['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php if($area['id']!=3) { ?>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $area['id'];?>)"
                                    role="button"> <i class="fas fa-trash-alt"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php include('editar.php'); ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <?php include('crear.php'); ?>

        </div>
    </div>
</div>


<?php include('../../templates/footer.php'); ?>