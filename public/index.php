<?php require('../api/includes/header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <style>
    body{
        background: url('fondo.png') no-repeat fixed center;
        -webkit-background-size:cover;
        -moz-background-size:cover;
        -o-background-size:cover;
        background-size:cover;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    footer {
            text-align: center;
            padding: 15px 0;
            background-color: #212529;
            color: #fff;
            margin-top: 50px;
        }
    
</style>
<title>DVB MUEBLES</title>
</head>
<body>
<?php
    
    
    require("../api/conexion.php");
    if(isset($_GET['retorno'])&& $_GET['retorno']==1){
        echo "<div class='alert alert-success'>¡Producto agregado exitosamente!</div>";
    }
    if (isset($_GET['recuperar'])&& $_GET['recuperar']==2){
        echo '<script> alert("Hubo problemas con el envio");</script>';
    }
    
    ?>
    
    <div class="container" style="padding-top:50px">
       <div class="row">
        <?php
        
           $consulta= mysqli_query($conexion,"SELECT * FROM producto WHERE destacar = 'si' and idestado=1");
           ?>
            <div class="col-md-8" style="background:#121212">
                <div align="center" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $active="active";
                           while ($r=mysqli_fetch_array($consulta)) {
                        ?>
                        <div class="carousel-item <?php echo $active;?>">
                            <div class="card" style="width: 34rem;background:#121212;color:white">
                                <a href="../api/producto.php?idproducto=<?php echo $r['idproducto'];?>"><img src="../public/ImagenesOriginales/<?php echo $r['imagen'];?>" class="card-img-top"></a>
                                <div class="card" style="width: 35rem;background:#121212;color:white;padding-top:10px;">
                                   <!--<div style="padding-top:25px;">-->
                                       <a title="más informacion" style="float:right;margin-right:25px;border-radius:30px" class="btn btn-dark card-text" href="#" data-toggle="modal" data-target="#info<?php echo $r['idproducto'];?>" onclick="vistos(<?php echo $r['idproducto']?>);"><i class="fas fa-info-circle">Mas Información</i></a>
                                   <!--</div>-->     
                                </div>
                            </div> 
                        </div>
			            <div  data-backdrop="static"  class="modal" id="info<?php echo $r['idproducto'];?>">
                            <div class="modal-dialog modal-lg" >
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#212121;color:white">
                                        <h4 class="modal-title">Información</h4>
                                        <button style="color:white" type="button" class="close" data-dismiss="modal">X</button>
                                    </div>
                                    <div class="modal-body" style="background:#121212;color:white">
		                                <div class="row">
		                                    <div class="col-md-6">
		                                        <img src="../public/ImagenesOriginales/<?php echo $r['imagen'];?>" style="width:100%"><br>
		                                    </div>
		                                    <div class="col-md-6">
		                                        <h6 style="padding-top:20px"><strong>Nombre: </strong><?php echo $r['nombre'];?></h6>
                                                <h6 style="padding-top:20px"><strong>Categorías: </strong><?php echo $r['categorias'];?></h6>
                                                <h6 style="padding-top:20px"><strong>Material: </strong><?php echo $r['material']." min";?></h6>
                                                <?php if ($r['destacar'] = 'si'){ ?>
                                                <h6 style="padding-top:20px"><strong>Producto destacado</strong></h6>
                                                <?php }else{ ?>
                                                <h6 style="padding-top:20px"><strong>Producto normal</strong></h6>    
                                                <?php } ?>
                                                <h6 style="padding-top:20px" align="center"><strong>Descripción </strong></h6>
                                                <h6><?php echo $r['descripcion'];?></h6>
		                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $active="";
                            }
                            ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4" style="color:white;background:#121212">
                <br>
                <h3>productos destacados</h3>
                <?php $consulta= mysqli_query($conexion,"SELECT * FROM producto WHERE destacar = 'si' and idestado=1"); ?>
                <div class="parent">
                    <div class="child">
                        <?php while ($r=mysqli_fetch_array($consulta)) { ?>
                            <div style="padding:2%;color:grey">
                                <p style="margin-right:20px">
	                                <a href="#" style="text-decoration:none;color:white" data-toggle="modal" data-target="#info<?php echo $r['idproducto'];?>" onclick="vistos(<?php echo $r['idproducto']?>);"><img src="../public/ImagenesOriginales/<?php echo $r['imagen'];?>" style="width:30%" align="left">
                                    <h4><?php echo $r['nombre'];?></h4></a>
                                    <?php echo $r['descripcion'];?>
                                </p>
                                <br clear="all">
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require("../api/includes/footer.php"); ?>
</body>
</html>
