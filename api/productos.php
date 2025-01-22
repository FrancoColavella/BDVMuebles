<!DOCTYPE html>
    <html>

    <head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <style>
        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #212529;
            color: #fff;
            margin-top: 50px;
        }
    </style>
    </head>
    <body>
        <?php
        
            if (isset($_GET['genero'])) {
                $productos = $_GET['genero'];
                if(!isset($_GET['pagina'])){
                header("location:productos.php?genero=$productos&pagina=1");
                }
        
            }
            require("includes/header.php");
            $consulta = mysqli_query($conexion, "SELECT * FROM producto where (categorias like '%$productos%') AND idestado=1");
            $productos_x_pag = 4;
            $total_productos = mysqli_num_rows($consulta);
            $paginas = $total_productos / $productos_x_pag;
            $paginas = ceil($paginas);
        ?>

       
            <div class="row">  
                <div class="col-md-4 menualta" style="width: 110px;margin-left: 102%;transform: translateX(-50%);">
                        <ul class="nav">
                        <?php if(isset($_SESSION['login']) && $_SESSION['login']>0){ ?>
                            <li class="nav-item" style="margin:3px">
                                <form method="POST" action="altaMod.php">
                                    <button class="btn btn-dark" style="margin-top: 3%;left: 100%;" name="alta" value="alta"><i class="far fa-arrow-alt-circle-up"></i>Alta Producto</button>
                                </form>
                            </li> 
                        <?php     
                            }
                        ?>
                        </ul>
                </div>     
            </div> 
            <div class="container">
            <h1 align="center" style="color:black;font-family:Latin Modern Roman;font-style: oblique;"><strong><?php echo $productos;?></strong></h1>
            <?php if (isset($_GET['estado'])&& $_GET['estado']==3) {
                        echo "<div class='alert alert-warning'>Ya existe otra producto con ese nombre, intente con otro!!</div>";
                    }
                  if (isset($_GET['estado'])&& $_GET['estado']==4) {
                        echo "<div class='alert alert-success'>Producto inactivada con exito!!</div>";
                    }
                     ?>
                    
              <div class="row">
                
            <?php 
            
            if (isset($_GET['pagina'])) {
               $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
               $consulta2 = mysqli_query($conexion, "SELECT * FROM producto WHERE (categorias like '%$productos%') AND idestado=1 ORDER BY idproducto DESC limit $iniciar,$productos_x_pag");
               while ($r = mysqli_fetch_array($consulta2)) { ?>
                    <div align="center" class="col-md-3" style="padding:1%;">    
                          <div class="card" style="width: 12.5rem;background:#212121;color:white">
                              <a href="producto.php?idproducto=<?php echo $r['idproducto'];?>"><img src="../public/ImagenesOriginales/<?php echo $r['imagen']; ?>" class="card-img-top"></a>
                              <p><?php echo "<i class='fas fa-star'></i>" . $r['material']; ?></p>
                              <div class="card-body" style="height:80px">
                                  <p align="center" class="card-text"><?php echo $r['nombre']; ?></p>
                                  <p><strong>Precio: </strong><?php echo "$".$r['precio']; ?></p>
                              </div>
                              <br>
                              <div style="padding-top:50px">
                              <?php 
                 
                              if(isset($_SESSION['login']) && $_SESSION['login'] > 0){
                              ?>     
                                   <form method="POST" action="altaMod.php">
                                        <button style="float: left;margin: 4px;border-radius:30px" type="submit" name="nombre" value="<?php echo $r['nombre']; ?>" class="btn btn-dark"><i class="fas fa-pencil-alt"></i></button>
                                   </form>
                                        <a style="float: left;margin: 4px;border-radius:30px" class="btn btn-dark" href="#" data-toggle="modal" data-target="#info<?php echo $r['idproducto']; ?>"><i class="fas fa-trash-alt"></i></a>
                                   <?php 
                                }
                                ?>

                                <a title="más informacion" style="float: right;margin: 4px;border-radius:30px" class="btn btn-dark" href="#" data-toggle="modal" data-target="#info<?php echo $r['idproducto'];?>"><i class="fas fa-info-circle"></i></a>
    
                                </div>
                          </div>
                    </div>
                    <div align="center" data-backdrop="static" class="modal" id="info<?php echo $r['idproducto']; ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#212121;color:white">
                                        <h4 class="modal-title">Información del producto</h4>
                                        <a style="color:white"  href="productos.php?genero=<?php echo $productos;?>&pagina=<?php echo $paginas;?>" class="close" data-dismiss="modal">X</a>
                                    </div>
                                    <div class="modal-body" style="background:#121212;color:white">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="../public/ImagenesOriginales/<?php echo $r['imagen']; ?>" style="width:50%"><br>
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
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] > 0) { ?>
                                                            <div class="col-md-6">
                                                                <input type="text" name="pag" id="pag" value="<?php echo $_GET['pagina'];?>" hidden>
                                                                <input type="text" name="categ" id="categ" value="<?php echo $productos;?>" hidden>
                                                                <input type="text" name="eliminarProducto" id="eliminarProducto" value="eliminarProducto" hidden>
                                                                <a style="margin: 5px;" href="#" onclick="eliminarProducto(<?php echo $r['idproducto']?>,<?php echo $_GET['pagina']?>)" class="btn btn-dark">Inactivar</a>
                                                            </div>
                                                    <?php 
                                                       } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>           
            <?php 
                   }
             ?>
         </div>
         </div>
         </div>
         
         <?php } ?>
                      <div class="container" style="padding-top:40px">
                        <nav arial-label="page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="productos.php?genero=<?php echo $productos; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                                <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                    <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="productos.php?genero=<?php echo $productos; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php endfor ?>
                                <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="productos.php?genero=<?php echo $productos; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                            </ul>
                        </nav>
                      </div>
                    <script>
                        function eliminarProducto(idProducto,pagina){
                            var eliminar = confirm('De verdad desea inactivar este producto');
                            var categoria=document.getElementById('categ').value;
                            var eliminarProducto=document.getElementById('eliminarProducto').value;
                            if ( eliminar ) {
                                
                                $.ajax({
                                    url: 'ABM.php',
                                    type: 'POST',
                                    data: { 
                                        id: idProducto,
                                        delete: eliminarProducto,
                                    
                                    },
                                })
                                .done(function(response){
                                    $("#result").html(response);
                                })
                                .fail(function(jqXHR){
                                    console.log(jqXHR.statusText);
                                });
                                window.location.href ='productos.php?genero='+categoria+'&pagina='+pagina+'&estado=4';
                            }
                        } 
                    </script>
                    <?php require("includes/footer.php"); ?>
    </body>
</html>