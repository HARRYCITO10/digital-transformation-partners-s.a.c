<?php
include('../../conexion.php');


$sentencia=$conexion->prepare("SELECT * FROM categorias");
$sentencia->execute();
$categorias=$sentencia->fetchAll(PDO::FETCH_ASSOC);


if ($_POST) {
 
    $txtid=(isset($_POST['txtid'])?$_POST['txtid']:"");
    $idcategoria=(isset($_POST['idcategoria'])?$_POST['idcategoria']:"");
    $nombre=(isset($_POST['nombre'])?$_POST['nombre']:"");
    $foto=(isset($_FILES['foto']['name'])?$_FILES['foto']['name']:"");
    $fecha=(isset($_POST['fecha'])?$_POST['fecha']:"");
    
    $sentencia=$conexion->prepare("UPDATE clientes SET idcategoria=:idcategoria,nombre=:nombre,fecha=:fecha WHERE id=:txtid");
    $sentencia->bindParam(":idcategoria",$idcategoria);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":txtid",$txtid);
    $sentencia->execute();
    
    $foto=(isset($_FILES['foto']['name'])?$_FILES['foto']['name']:"");

    $fechas=new DateTime();
    
    $nombrefoto=($foto!='')?$fechas->getTimestamp()."_".$_FILES['foto']['name']:"";
    $tmp_foto=$_FILES['foto']['tmp_name'];
    if($tmp_foto!=''){
      move_uploaded_file($tmp_foto,"./img/".$nombrefoto);
      $sentencia=$conexion->prepare("SELECT foto FROM clientes WHERE id=:idtxt");
      $sentencia->bindParam(":idtxt",$txtid);
      $sentencia->execute();
      $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
  
      if(isset($registro_recuperado['foto']) && $registro_recuperado['foto']!=""){
          if(file_exists("./img/".$registro_recuperado['foto'])){
              unlink("./img/".$registro_recuperado['foto']);
          }
      }

      $sentencia=$conexion->prepare("UPDATE clientes SET foto=:foto WHERE id=:txtid");
      $sentencia->bindParam(":foto",$nombrefoto);
      $sentencia->bindParam(":txtid",$txtid);
      $sentencia->execute();
    }

    
    echo '<script>window.location.href = "index.php";</script>';
    
    }



?>



<!-- Modal edit -->
<div class="modal fade" id="edit<?php echo $cliente['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR CLIENTES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editar.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">

                        <input type="hidden" value="<?php echo $cliente['id'];?>" class="form-control" name="txtid"
                            id="txtid" aria-describedby="helpId">
                    </div>


                    <div class="mb-3">
                        <label for="idcategoria" class="form-label">Categoria:</label>
                        <select class=" form-control form-select form-select-sm" name="idcategoria" id="idcategoria">
                            <?php foreach($categorias as $categoria) {  ?>
                            <option <?php echo ($cliente['idcategoria']==$categoria['id'])?"selected":"";?>
                                value="<?php echo $categoria['id'];?>"><?php echo $categoria['nombre']; ?></option>
                            <?php  } ?>
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                            value="<?php echo $cliente['nombre'];?>">
                    </div>
                    <div class="mb-3">

                        <label for="" class="form-label">Foto</label><br>
                        <img width="50" height="10" src="img/<?php echo $cliente['foto']; ?>" class="img-fluid rounded"
                            alt="">
                        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId"
                            placeholder="">
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId"
                            value="<?php echo $cliente['fecha'];?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>