
<!DOCTYPE html>
 <html>
   <head>
    <title><?php if (isset($_POST['nombre'])) { echo "Modificar Producto";}else{echo "Alta Producto";}?></title> 
   </head>
   <body>
   <?php require ("includes/header.php");
   require ("conexion.php");
  ?>
    <div class="container" style="padding-top:40px;">
		<div class="row">
        
            <div align="center" class="col-md-12 altamod">
            <?php 
                 if (isset($_POST['nombre'])) {
                      $nombre=$_POST['nombre'];
                      $consulta="SELECT * FROM producto WHERE nombre='$nombre'";
                      $tipoestado=mysqli_query($conexion,"SELECT idestado FROM producto WHERE nombre='$nombre'");
                      while($i=mysqli_fetch_array($tipoestado)){
                          $idTipoEstado=$i['idestado'];
                      }  
                      $resultado=mysqli_query($conexion,$consulta);
                      $datos_generos=mysqli_fetch_assoc($resultado);
                      $generos=explode(' ', $datos_generos['categorias']);
                      $rta=in_array(' ',$generos);
                  ?><h1 align="center" style="color:white">Editar producto </h1>
                       <form method="POST" action="ABM.php" enctype="multipart/form-data" style="width:70%;">
                         <div class="form-row">
                             <div class="form-group col-md-8">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $datos_generos['nombre'];?>" required>
                                <input type="text" class="form-control" name="nombre_anterior" id="nombre_anterior" value="<?php echo $datos_generos['nombre'];?>" hidden>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="inputPassword4">Material</label>
                                  <input type="text" class="form-control" value="<?php echo $datos_generos['material'];?>" name="material" id="material" require>
                             </div>
                         </div>
                         <div class="form-row">
                            <div class="form-check col-md-2"  style="padding-top:40px">
                                <input class="form-check-input" type="checkbox" name="destacar" value="Si" id="defaultCheck1" <?php if($datos_generos['destacar']='si'){?> checked <?php }?>>
                                <label class="form-check-label" for="defaultCheck1">
                                    Destacar
                                </label>
                            </div>
                             <div class="form-group col-md-5">
                                <label for="inputPassword4">Precio</label>
                                <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $datos_generos['precio'];?>" required onkeyup="this.value=Numeros(this.value)">
                             </div>
                             <div class="form-group col-md-5">
								<label>Estado</label>
								<select name="estado" class="form-control" >
										<option value="1" <?php  if($idTipoEstado==1){ echo'selected';}?>>1</option>
                                        <option value="2" <?php  if($idTipoEstado==2){ echo'selected';}?>>2</option>
								</select>
							</div>
                         </div>
                         <div class="form-group">
                            <label>Descripción</label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" rows="3"require ><?php echo $datos_generos['descripcion'];?></textarea>
                         </div>
                         <div class="form-row">
                              <div class="form-group col-md-8">
                                 <label for="imagen">Imagen Portada</label>
 					             <input type="file" name="imagen" class="form-control" id="imagen" >
                              </div>
                              <div class="form-group col-md-4">
                                  <img src="<?php echo "../public/ImagenesOriginales/". $datos_generos["imagen"]; ?>" width =100>
                             </div>
                          </div>
                         <p style="color:#fafafa;float:left">Géneros</p><br>
                         <div class="form-row"  style="border: 1px solid white;color:#fafafa;padding-top:20px;float:left;width:100%">
                             <div class="form-group">
                                <label class="checkbox">
                                    Mesa
                                    <input type="checkbox" name="nombre_genero[]" value="Mesa" <?php if(in_array('Mesa',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Escritorio
                                    <input type="checkbox" name="nombre_genero[]" value="Escritorio" <?php if(in_array('Escritorio',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Perchero
                                   <input type="checkbox" name="nombre_genero[]" value="Perchero" <?php if(in_array('Perchero',$generos)){?> checked <?php }?>>
                                   <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Cama
                                    <input type="checkbox" name="nombre_genero[]" value="Cama" <?php if(in_array('Cama',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Silla
                                    <input type="checkbox" name="nombre_genero[]" value="Silla" <?php if(in_array('Silla',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Sillon
                                    <input type="checkbox" name="nombre_genero[]" value="Sillon" <?php if(in_array('Sillon',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                             </div>
                         </div> 
                         <div class="form-group">
                             <button type="submit" class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="Modificar" name="Modificar"><i class="fas fa-save"></i> Guardar</button>
                             <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="javascript:history.go(-1)"><i class="fas fa-ban"></i> Cancelar</a></button>
                             
                         </div>
                       </form>
                      <?php 
                  }
                 if(isset($_POST['alta']) && !empty($_POST['alta'])){ ?>
                 <h1 align="center" style="color:white">Alta producto </h1>
                    
                    <form method="POST" action="ABM.php" enctype="multipart/form-data" style="width:70%;">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                               <label for="inputEmail4">Nombre</label>
                               <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Ingrese nombre del producto" >
                            </div>
                            <div class="form-group col-md-4">
                               <label for="inputPassword4">Material</label>
                               <input type="text" class="form-control" name="material" id="material" required placeholder="Ingrese el tipo de material del producto">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-check col-md-2"  style="padding-top:40px">
                                <input class="form-check-input" type="checkbox" name="destacar" value="Si" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Destacar
                                </label>
                            </div>
                            <div class="form-group col-md-5">
								<label>Estado</label>
								<select name="estado" class="form-control" >
										<option>1</option>
                                        <option>2</option>
								</select>
							</div>
                            <div class="form-group col-md-5">
                                        <label for="inputPassword4">Precio</label>
                                        <input type="text" class="form-control" name="precio" id="precio" required placeholder="Ingrese precio en minutos" onkeyup="this.value=Numeros(this.value)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">Descripción</label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required placeholder="Ingrese descripción de la película" ></textarea>
                        </div>
                        <div class="form-row">       
                            <div class="form-group col-md-4">
                                   <label for="imagen">Imagen Portada</label>
 					               <input type="file" name="imagen" class="form-control" id="imagen" require>
                            </div>
                            <div class="form-group col-md-4">
                                   <label for="imagen1">Imagen</label>
 					               <input type="file" name="imagen1" class="form-control" id="imagen1" >
                            </div>
                            <div class="form-group col-md-4">
                                   <label for="imagen2">Imagen</label>
 					               <input type="file" name="imagen2" class="form-control" id="imagen2" >
                            </div>       
                        </div>
                        <div class="form-row">       
                            <div class="form-group col-md-4">
                                   <label for="imagen3">Imagen</label>
 					               <input type="file" name="imagen3" class="form-control" id="imagen3" >
                            </div>       
                            <div class="form-group col-md-4">
                                   <label for="imagen4">Imagen</label>
 					               <input type="file" name="imagen4" class="form-control" id="imagen4" >
                            </div>
                            <div class="form-group col-md-4">
                                   <label for="imagen5">Imagen</label>
 					               <input type="file" name="imagen5" class="form-control" id="imagen5" >
                            </div>
                        </div>
                        <div class="form-row">       
                            <div class="form-group col-md-4">
                                   <label for="imagen6">Imagen</label>
 					               <input type="file" name="imagen6" class="form-control" id="imagen6" >
                            </div>
                            <div class="form-group col-md-4">
                                   <label for="imagen7">Imagen</label>
 					               <input type="file" name="imagen7" class="form-control" id="imagen7" >
                            </div>
                            <div class="form-group col-md-4">
                                   <label for="imagen8">Imagen</label>
 					               <input type="file" name="imagen8" class="form-control" id="imagen8" >
                            </div>       
                        </div>
                        <p style="color:#fafafa;float:left">Géneros</p><br>
                        <div class="form-row"  style="border: 1px solid white;padding-top:20px;color:#fafafa;float:left;width:100%">
                            <div class="form-group generos">
                                <label class="checkbox">
                                    Mesa
                                    <input type="checkbox" name="nombre_genero[]" value="Mesa">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Escritorio
                                    <input type="checkbox" name="nombre_genero[]" value="Escritorio">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Perchero
                                    <input type="checkbox" name="nombre_genero[]" value="Perchero">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Cama
                                    <input type="checkbox" name="nombre_genero[]" value="Cama">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Silla
                                    <input type="checkbox" name="nombre_genero[]" value="Silla">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Sillon
                                    <input type="checkbox" name="nombre_genero[]" value="Sillon">
                                    <span class="check"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="guardar" name="guardar"><i class="fas fa-save"></i> Guardar</button>
                            <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="javascript:history.go(-1)"><i class="fas fa-ban"></i> Cancelar</a></button>
                        </div>
                    </form>
                    <?php
                  }

 ?>
 </div>
               
</div>
</div>
    <script>

function Numeros(string){
    var out = '';
    ok=true;
    var filtro = '1234567890';
    for (var i=0; i<20; i++)
       if (filtro.indexOf(string.charAt(i)) != -1)
	     out += string.charAt(i);
    
         return out;
}
function filterFloat(evt,input){
        var key = window.Event ? evt.which : evt.keyCode;    
        var chark = String.fromCharCode(key);
        var tempValue = input.value+chark;
        if(key >= 48 && key <= 57){
            if(filter(tempValue)=== false){
                return false;
            }else{       
                return true;
            }
        }else{
              if(key == 8 || key == 13 || key == 0) {     
                  return true;              
              }else if(key == 46){
                    if(filter(tempValue)=== false){
                        return false;
                    }else{       
                        return true;
                    }
              }else{
                  return false;
              }
        }
    }
    function filter(__val__){
        var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
        if(preg.test(__val__) === true){
            return true;
        }else{
           return false;
        }
        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros y letras
            patron = /[A-Za-z0-9_-]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
        
    }
    </script>
   </body>
</html>