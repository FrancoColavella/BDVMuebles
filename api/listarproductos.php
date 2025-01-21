<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Productos</title>
</head>

<body>
    <?php   
    $asc = 0;
    
    if(!isset($_GET['pagina'])){
      header("location:listarproductos.php?pagina=1");
      }
      include "conexion.php";
      $est=$_GET['est'];
  $sql = "SELECT * FROM producto WHERE idestado = $est";
  /*$estados=mysqli_query($conexion,"SELECT distinct idestado FROM producto WHERE idestado=1 OR idestado=2 ORDER BY descripcion ASC");*/
  $consulta = mysqli_query($conexion,$sql);
  if(isset($_GET['orden'])){
    if(isset($_GET['ascendente'])){
      if($_GET['ascendente']==1){
        $sql2 = " ASC";
        $asc = 0;
      }else{
        $sql2 = " DESC";
        $asc = 1;
      }
    }
    $sql.=" ORDER BY " . $_GET['orden'] . $sql2;
  }
  $productos_x_pag = 5;
  $total_productos = mysqli_num_rows($consulta);
  $paginas = $total_productos / $productos_x_pag;
  $paginas = ceil($paginas);
  if (isset($_GET['pagina'])) {
    require("header.php");
    $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
    $resultado = mysqli_query($conexion,$sql . " limit $iniciar,$productos_x_pag");
  }
    ?>
    <script language="javascript">
      
      $(document).ready(function(){
      
        $("#Est").change(function () {	
          $("#Est option:selected").each(function () {
            id_estado = $(this).val();
          
            window.location.href="listarproductos.php?pagina=1&est="+id_estado;
                      
          });
          
        });
        
      });
 </script>
    <div class="container">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center text-black">Listado de Productos</h3>
        <?php if (isset($_GET['estado'])&& $_GET['estado']==1) {
                echo "<div class='alert alert-success'>Producto inactivado con exito!!</div>";
              }
              if (isset($_GET['estado'])&& $_GET['estado']==2) {
                echo "<div class='alert alert-success'>Producto activado con exito!!</div>";
              }?>
        <form action="buscarProducto.php?pagina=1" method="POST">
             <div class="input-group-prepend">
             <input id="nombre_producto" name="nombre_producto" style="background:black;color:white" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Ingrese nombre a buscar">
                  <input id="estado" name="estado" type="text" value="<?php echo $_GET['est'];?>" hidden>
                <div class="input-group-append">
                  <button style="border-color: white" class="btn btn-outline-dark" type="submit" name="Buscar" value="Buscar" id="button-addon2"><i class="fas fa-search"></i></button>
                  </div>

            </div>
        </form>
        <table class="table table-light">
          <thead>
          
            <th scope ="col"><a href="listarproductos.php?pagina=1&est=<?php echo $_GET['est'];?>&orden=idproducto&ascendente=<?php echo $asc; ?>" >Id</a></th>
            <th scope ="col"><a href="listarproductos.php?pagina=1&est=<?php echo $_GET['est'];?>&orden=nombre&ascendente=<?php echo $asc; ?>" >Nombre</a></th>
            <th scope ="col"><a href="listarproductos.php?pagina=1&est=<?php echo $_GET['est'];?>&orden=material&ascendente=<?php echo $asc; ?>" >Material</a></th>
            <th scope ="col"><a href="listarproductos.php?pagina=1&est=<?php echo $_GET['est'];?>&orden=precio&ascendente=<?php echo $asc; ?>" > Precio</a></th>
            <th scope ="col"><a href="listarproductos.php?pagina=1&est=<?php echo $_GET['est'];?>&orden=categorias&ascendente=<?php echo $asc; ?>" > Categorías </a></th>
            <th scope ="col">Estado</th>
            <th>
              <?php if($_GET['est']==1){ ?>
                <form action="altaMod.php" method="POST">
                  <button name='alta' value='alta' class="btn btn-warning">Nuevo</button>
                </form></th>
              <?php }?>
            <th>
              <select name="Est" id="Est">
                 <option value='1' <?php if($_GET['est']==1) echo 'Selected'?>>Activos</option>
                 <option value='2' <?php if($_GET['est']==2) echo 'Selected'?>>Inactivos</option>
						  </select>
            </th>
            
</thead> 
<?php
  
    while($fila = $resultado->fetch_assoc()){

      echo "<tr>";
      echo "<td>"; echo $fila['idproducto']; echo "</td>";
      echo "<td>"; echo $fila['nombre']; echo "</td>";
      echo "<td>"; echo $fila['material']; echo "</td>";
      echo "<td>"; echo '$' . $fila['precio']; echo "</td>";
      echo "<td>"; echo $fila['categorias']; echo "</td>";
      echo "<td>"; echo $fila['idestado']; echo "</td>";
      /*$tipoestado=mysqli_query($conexion,"SELECT idestado FROM producto WHERE idproducto='{$fila['idproducto']}'");
                      while($i=mysqli_fetch_array($tipoestado)){
                          $idTipoEstado=$i['idestado'];
                      } 
      $selectEstado=mysqli_query($conexion,"SELECT idestado,descripcion FROM pelicula_estados WHERE idestado = $idTipoEstado ORDER BY descripcion ASC");
                      while($i=mysqli_fetch_array($selectEstado)){
                        $descripcion=$i['descripcion'];
                      } */
                      

      echo "<td><form action='AltaMod.php' method='post'>
                    <input name='nombre' id='nombre' value='".$fila['nombre']."' hidden>
                    <button type='submit' class='btn btn-success'>Modificar</button>
                </form>
            </td>";
            if($_GET['est']==1){
              echo '<td><input type="text" name="eliminarProducto" id="eliminarProducto" value="eliminarProducto" hidden>
                    <input type="text" name="pagina" id="pagina" value="'.$_GET['pagina'].'" hidden>
                    <a style="margin: 5px;" href="#" onclick="eliminarProducto('.$fila['idproducto'].','.$_GET['pagina'].','.$_GET['est'].')" class="btn btn-danger">Inactivar</a></td>';
            }else{  
              echo "<td><form action='ABM.php' method='post'>
                      <input name='id' id='id' value='".$fila['idproducto']."'hidden>
                      <button class='btn btn-danger' name='activar' id='activar' value='activar'>Activar</button>
                    </form>
                  </td>";
              }
            }
  ?>
          </table>
          
        </div>
      </div>
  </div>

      ?>
      <div class="container" style="padding-top:40px">
                        <nav arial-label="page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="listarproductos.php?pagina=<?php echo $_GET['pagina'] - 1 ?>&est=<?php echo $_GET['est'];?>">Anterior</a></li>
                                <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                    <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="listarproductos.php?pagina=<?php echo $i ?>&est=<?php echo $_GET['est'];?>"><?php echo $i ?></a></li>
                                <?php endfor ?>
                                <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="listarproductos.php?pagina=<?php echo $_GET['pagina'] + 1 ?>&est=<?php echo $_GET['est'];?>">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
        <script>
                        function eliminarProducto(idproducto,pagina,estado){
                            var eliminar = confirm('De verdad desea inactivar este producto');
                            var eliminarProducto=document.getElementById('eliminarProducto').value;
                            if ( eliminar ) {
                                
                                $.ajax({
                                    url: 'ABM.php',
                                    type: 'POST',
                                    data: { 
                                        id: idproducto,
                                        delete: eliminarProducto,
                                        est: estado,
                                    
                                    },
                                })
                                .done(function(response){
                                    $("#result").html(response);
                                })
                                .fail(function(jqXHR){
                                    console.log(jqXHR.statusText);
                                });
                                window.location.href ='listarproductos.php?pagina='+pagina+'&est='+estado+'&estado=1';
                            }
                        } 
         </script>

</body>

</html>