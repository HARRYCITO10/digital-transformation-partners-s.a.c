<?php 
include('../../templates/template.php');

include("../../conexion.php");

if(isset($_GET['id'])){

    $txtid=(isset($_GET['id'])? $_GET['id']:"");

    $sentencia=$conexion->prepare("SELECT archivo FROM expedientes WHERE id=:idtxt");
    $sentencia->bindParam(":idtxt",$txtid);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado['archivo']) && $registro_recuperado['archivo']!=""){
        if(file_exists("../../public/expedientes/".$registro_recuperado['archivo'])){
            unlink("../../public/expedientes/".$registro_recuperado['archivo']);
        }
    }


    $sentencia=$conexion->prepare("DELETE FROM expedientes WHERE id=:idtxt");
    $sentencia->bindParam(":idtxt",$txtid);
    $sentencia->execute();
    echo '<script>window.location.href = "index.php";</script>';
    
    }


$idarea_usuario = $_SESSION['idarea'];

if ($idarea_usuario == 3) {
    $sentencia = $conexion->prepare("SELECT * FROM expedientes");
} else {
    $sentencia = $conexion->prepare("SELECT * FROM expedientes WHERE idarea_destino = :idarea_usuario");
    $sentencia->bindParam(':idarea_usuario', $idarea_usuario);
}

$sentencia->execute();
$expedientes=$sentencia->fetchAll(PDO::FETCH_ASSOC);
 ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Expedientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">home</a></li>
                        <li class="breadcrumb-item active">expedientes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            
          <!--  <a href="crear.php" class="btn btn-primary"> <i class="fas fa-plus"></i> Nuevo</a> -->
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha/hora</th>
                            <th>Remitente</th>
                            <th>Asunto</th>
                            <th>Nro expediente</th>
                            <th>Código</th>
                            <th>Archivo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        <?php foreach($expedientes as $expediente) { ?>
                        <tr class="">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $expediente['fecha'].' '. $expediente['hora'] ; ?> </td>
                            <td><?php echo $expediente['remitente']; ?> </td>
                            <td><?php echo $expediente['asunto']; ?></td>
                            <td><?php echo $expediente['num_expediente']; ?></td>
                            <td><?php echo $expediente['cod_seguridad']; ?></td>
                            <td><a href="../../public/expedientes/<?php echo $expediente['archivo'];  ?>" class="btn btn-success" target="_blank"><i class="fas fa-eye"></i></a></td>
                            <td>
                                <?php 
                                if($expediente['estado']=='pendiente'){
                                    echo '<span class="badge badge-warning">Pendiente</span>';
                                } elseif($expediente['estado']=='en tramite') {

                                    echo '<span class="badge badge-success">en trámite</span>';
                                } elseif($expediente['estado']=='atendido'){
                                    echo '<span class="badge badge-primary">Atendido</span>';
                                }else{
                                    echo '<span class="badge badge-danger">Denegado</span>';
                                }
                            
                                  ?>
                            </td>
                            <td>
                                <a href="atender.php?id=<?php echo $expediente['id'];  ?>" class="btn btn-info">Atender</a>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#derivar<?php echo $expediente['id']; ?>">Derivar
                                </button>
                                <?php if($idarea_usuario==3) { ?>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $expediente['id'];?>)"
                                    role="button"> <i class="fas fa-trash-alt"></i></a>
                                    <?php   }  ?>
                            </td>
                        </tr>
                        <?php include('derivar.php');  ?>
                        <?php   } ?>
                    </tbody>
                </table>
            </div>
        

        </div>

    </div>
</div>

<?php include('../../templates/footer.php'); ?>