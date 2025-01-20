
<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
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
      require("header.php");
      require("conexion.php");   

   ?>
   <div class="container">
   <?php if (isset($_GET['estado'])&& $_GET['estado']==1) {
            echo "<div class='alert alert-success'>Producto agregado con exito!!</div>";
          }
          if (isset($_GET['estado'])&& $_GET['estado']==2) {
            echo "<div class='alert alert-success'>Producto modificado con exito!!</div>";
          }?>
        <h1 align="center" style="color:black;padding:20px;font-family:Latin Modern Roman;font-style: oblique;font-weight: 700;">Categorias</h1>
       <div class="row">
         <?php 
              $select=mysqli_query($conexion,"SELECT * FROM categoria");
              while($r=mysqli_fetch_array($select)){
         ?>     
         <div class="col-md-4" align="center" style="padding:20px;">
                  <h4><strong style="color:black;font-family:Latin Modern Roman;font-style: oblique;"><?php echo $r['nombrecategoria'];?></strong></h4>
                  <a href="productos.php?genero=<?php echo $r['nombrecategoria'];?>"><img src="categorias/<?php echo $r['imagen'];?>" style="width:60%;border-radius:20px"></a>
                </div>
         <?php }?>
       </div>
   </div>
   <?php require("footer.php"); ?>
 </body>
</html>


