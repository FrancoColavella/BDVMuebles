
<?php
require("conexion.php");

use BenMajor\ImageResize\Image;

require "vendor/autoload.php";
function imagen(){
	require("conexion.php");
    if (isset($_POST['Modificar'])) {
        $nombre=$_POST['nombre'];
        $consulta= "SELECT idproducto,imagen from producto where nombre='$nombre'";
        $query=mysqli_query($conexion,$consulta);
       //     $imgBD=$query->fetch_array(MYSQL_ASSOC);
        
        if (empty($_FILES['imagen'])) {
            return $imgBD['imagen'];
        }else{
            if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                
                $errores=0;
				$ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
				$name = pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME).".". $ext;
		
				// Verificar si el archivo es un JPG válido antes de intentar cargarlo
				$uploadedFile = $_FILES['imagen']['tmp_name'];
				$fileInfo = getimagesize($uploadedFile);
			
				if ($fileInfo === false || $fileInfo[2] !== IMAGETYPE_JPEG) {
					echo "El archivo no es un JPG válido.<br>";
					return false;
				}
				
				// Cargar la imagen desde el archivo temporal
				$imagen = imagecreatefromjpeg($uploadedFile);
		
				if ($imagen === false) {
					echo "Error al cargar la imagen. Asegúrate de que sea un archivo JPG válido.<br>";
					return false;
				}

				$anchoOriginal = imagesx($imagen);
				$altoOriginal = imagesy($imagen);

				$directorioOriginal = "ImagenesOriginales";
				// Definir el tamaño final de las imágenes (por ejemplo, 400x400)
				$tamañoFinal = 400;
		
				// Calculamos el tamaño para redimensionar la imagen manteniendo la proporción
				$proporción = min($tamañoFinal / $anchoOriginal, $tamañoFinal / $altoOriginal);
				$anchoRedimensionado = (int)($anchoOriginal * $proporción);
				$altoRedimensionado = (int)($altoOriginal * $proporción);
		
				// Redimensionar la imagen original para que se ajuste a las dimensiones deseadas
				$imagenRedimensionada = imagecreatetruecolor($anchoRedimensionado, $altoRedimensionado);
				imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoRedimensionado, $altoRedimensionado, $anchoOriginal, $altoOriginal);
		
				// Crear la imagen cuadrada con fondo negro
				$imagenCuadrada = imagecreatetruecolor($tamañoFinal, $tamañoFinal);
				
				// Asignar el color de fondo negro
				$fondoNegro = imagecolorallocate($imagenCuadrada, 0, 0, 0);
				imagefill($imagenCuadrada, 0, 0, $fondoNegro);
		
				// Calcular el desplazamiento para centrar la imagen
				$xOffset = ($tamañoFinal - $anchoRedimensionado) / 2;
				$yOffset = ($tamañoFinal - $altoRedimensionado) / 2;
		
				// Copiar la imagen redimensionada al centro de la imagen cuadrada
				imagecopy($imagenCuadrada, $imagenRedimensionada, $xOffset, $yOffset, 0, 0, $anchoRedimensionado, $altoRedimensionado);
		
				// Crear la ruta donde se guardará la imagen redimensionada
				$pathOriginal = $directorioOriginal . "/" . $name;

				if (imagejpeg($imagenCuadrada, $pathOriginal)) {
					echo "Imagen redimensionada y guardada en: {$pathOriginal}<br>";
				} else {
					echo "Error al guardar la imagen redimensionada.<br>";
					return false;
				}
			
				// Liberar memoria
				imagedestroy($imagen);
				imagedestroy($imagenRedimensionada);
				imagedestroy($imagenCuadrada);
			
				return $name;
       
			} 
		}
	}

	if (isset($_POST['agregar'])) {
        if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                
            $errores=0;
			$ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
			$name = pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME).".". $ext;
	
			// Verificar si el archivo es un JPG válido antes de intentar cargarlo
			$uploadedFile = $_FILES['imagen']['tmp_name'];
			$fileInfo = getimagesize($uploadedFile);
		
			if ($fileInfo === false || $fileInfo[2] !== IMAGETYPE_JPEG) {
				echo "El archivo no es un JPG válido.<br>";
				return false;
			}
				
			// Cargar la imagen desde el archivo temporal
			$imagen = imagecreatefromjpeg($uploadedFile);
		
			if ($imagen === false) {
				echo "Error al cargar la imagen. Asegúrate de que sea un archivo JPG válido.<br>";
				return false;
			}

			$anchoOriginal = imagesx($imagen);
			$altoOriginal = imagesy($imagen);

			$directorioOriginal = "ImagenesOriginales";
			// Definir el tamaño final de las imágenes (por ejemplo, 400x400)
			$tamañoFinal = 400;
		
			// Calculamos el tamaño para redimensionar la imagen manteniendo la proporción
			$proporción = min($tamañoFinal / $anchoOriginal, $tamañoFinal / $altoOriginal);
			$anchoRedimensionado = (int)($anchoOriginal * $proporción);
			$altoRedimensionado = (int)($altoOriginal * $proporción);
		
			// Redimensionar la imagen original para que se ajuste a las dimensiones deseadas
			$imagenRedimensionada = imagecreatetruecolor($anchoRedimensionado, $altoRedimensionado);
			imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoRedimensionado, $altoRedimensionado, $anchoOriginal, $altoOriginal);
		
			// Crear la imagen cuadrada con fondo negro
			$imagenCuadrada = imagecreatetruecolor($tamañoFinal, $tamañoFinal);
				
			// Asignar el color de fondo negro
			$fondoNegro = imagecolorallocate($imagenCuadrada, 0, 0, 0);
			imagefill($imagenCuadrada, 0, 0, $fondoNegro);
		
			// Calcular el desplazamiento para centrar la imagen
			$xOffset = ($tamañoFinal - $anchoRedimensionado) / 2;
			$yOffset = ($tamañoFinal - $altoRedimensionado) / 2;
		
			// Copiar la imagen redimensionada al centro de la imagen cuadrada
			imagecopy($imagenCuadrada, $imagenRedimensionada, $xOffset, $yOffset, 0, 0, $anchoRedimensionado, $altoRedimensionado);
		
			// Crear la ruta donde se guardará la imagen redimensionada
			$pathOriginal = $directorioOriginal . "/" . $name;

			if (imagejpeg($imagenCuadrada, $pathOriginal)) {
				echo "Imagen redimensionada y guardada en: {$pathOriginal}<br>";
			} else {
				echo "Error al guardar la imagen redimensionada.<br>";
				return false;
			}
			
			// Liberar memoria
			imagedestroy($imagen);
			imagedestroy($imagenRedimensionada);
			imagedestroy($imagenCuadrada);
			
			return $name;
       
		}	
	}
    
    if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {

		
		// Inicializamos un array de errores
		$errores = [];
		
		// Función para mover y redimensionar imágenes
		function moverYRedimensionarImagen($file, $directorioOriginal, $tamañoFinal) {
			// Comprobamos si el archivo tiene un nombre válido y si no está vacío
			if (empty($file['name'])) {
				return false; // Si no hay archivo, no hacemos nada
			}
		
			// Obtener la extensión del archivo
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$name = pathinfo($file['name'], PATHINFO_FILENAME) . "." . $ext;
		
			// Verificar si el archivo es un JPG válido antes de intentar cargarlo
			$uploadedFile = $file['tmp_name'];
			$fileInfo = getimagesize($uploadedFile);
			
			if ($fileInfo === false || $fileInfo[2] !== IMAGETYPE_JPEG) {
				echo "El archivo no es un JPG válido.<br>";
				return false;
			}
		
			// Cargar la imagen desde el archivo temporal
			$imagen = imagecreatefromjpeg($uploadedFile);
		
			if ($imagen === false) {
				echo "Error al cargar la imagen. Asegúrate de que sea un archivo JPG válido.<br>";
				return false;
			}
		
			// Obtener el tamaño original de la imagen
			$anchoOriginal = imagesx($imagen);
			$altoOriginal = imagesy($imagen);
		
			// Calculamos el tamaño para redimensionar la imagen manteniendo la proporción
			$proporción = min($tamañoFinal / $anchoOriginal, $tamañoFinal / $altoOriginal);
			$anchoRedimensionado = (int)($anchoOriginal * $proporción);
			$altoRedimensionado = (int)($altoOriginal * $proporción);
		
			// Redimensionar la imagen original para que se ajuste a las dimensiones deseadas
			$imagenRedimensionada = imagecreatetruecolor($anchoRedimensionado, $altoRedimensionado);
			imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoRedimensionado, $altoRedimensionado, $anchoOriginal, $altoOriginal);
		
			// Crear la imagen cuadrada con fondo negro
			$imagenCuadrada = imagecreatetruecolor($tamañoFinal, $tamañoFinal);
		
			// Asignar el color de fondo negro
			$fondoNegro = imagecolorallocate($imagenCuadrada, 0, 0, 0);
			imagefill($imagenCuadrada, 0, 0, $fondoNegro);
		
			// Calcular el desplazamiento para centrar la imagen
			$xOffset = ($tamañoFinal - $anchoRedimensionado) / 2;
			$yOffset = ($tamañoFinal - $altoRedimensionado) / 2;
		
			// Copiar la imagen redimensionada al centro de la imagen cuadrada
			imagecopy($imagenCuadrada, $imagenRedimensionada, $xOffset, $yOffset, 0, 0, $anchoRedimensionado, $altoRedimensionado);
		
			// Crear la ruta donde se guardará la imagen redimensionada
			$pathOriginal = $directorioOriginal . "/" . $name;
		
			// Guardar la imagen cuadrada redimensionada en la carpeta de imágenes originales
			if (imagejpeg($imagenCuadrada, $pathOriginal)) {
				echo "Imagen redimensionada y guardada en: {$pathOriginal}<br>";
			} else {
				echo "Error al guardar la imagen redimensionada.<br>";
				return false;
			}
		
			// Liberar memoria
			imagedestroy($imagen);
			imagedestroy($imagenRedimensionada);
			imagedestroy($imagenCuadrada);
		
			return true;
		}
		
		// Definir la ruta de la carpeta de imágenes originales
		$directorioOriginal = "ImagenesOriginales";
		// Definir el tamaño final de las imágenes (por ejemplo, 400x400)
		$tamañoFinal = 400;
		
		// Procesar cada imagen (hasta 9 imágenes)
		for ($i = 0; $i <= 8; $i++) {
			// Construir el nombre de la clave que esperamos en el array $_FILES
			$key = $i === 0 ? 'imagen' : 'imagen' . $i;
		
			// Comprobar si la imagen existe en el array $_FILES
			if (isset($_FILES[$key])) {
				$file = $_FILES[$key];
		
				// Llamar a la función para mover y redimensionar la imagen
				moverYRedimensionarImagen($file, $directorioOriginal, $tamañoFinal);
			}
		}
		
	}	
}
if (isset($_POST['guardar']) && !empty($_POST['guardar'])) {
	
	imagen();
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$material = $_POST['material'];
	$precio = $_POST['precio'];
	$estado=$_POST['estado'];
	$destacar=$_POST['destacar'];
	$generos='';
	if(isset($_POST['nombre_genero'])){
	   foreach($_POST['nombre_genero'] as $selected){
		  $generos=$generos.' '.$selected;
	   }
	}
	$registros=mysqli_query($conexion,"SELECT nombre from producto WHERE nombre='$nombre'");
	if(mysqli_num_rows($registros)>0){  
		$select=mysqli_query($conexion,"SELECT categorias FROM producto WHERE nombre='$nombre'");
		while($r=mysqli_fetch_array($select)){$nombre_genero=$r['categorias'];}
		header("location:productos.php?genero=$nombre_genero&estado=3");         
	}else{
		// Asegúrate de que $conexion esté correctamente conectado antes de este código.

		for ($a = 0; $a <= 8; $a++) {
			// Construir el nombre de la clave que esperamos en el array $_FILES
			$keys = $a === 0 ? 'imagen' : 'imagen' . $a;
		
			// Comprobar si la imagen existe en el array $_FILES
			if (isset($_FILES[$keys])) {
				$file = $_FILES[$keys];
		
				// Obtener la extensión y el nombre del archivo sin extensión
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$nombreArchivo = pathinfo($file['name'], PATHINFO_FILENAME) . "." . $ext;
		
				// Realizar el insert en la base de datos solo con la primera imagen
				$Insert = mysqli_query($conexion, "INSERT INTO producto 
				VALUES (00, '$nombre', '$material', $precio, '$descripcion', '$destacar', '$nombreArchivo', $estado, '$generos')");

				if ($Insert) {
					echo "Producto insertado exitosamente.";
				} else {
					echo "Error al insertar el producto: " . mysqli_error($conexion);
				}
				break;  // Salir del bucle después de obtener la primera imagen
				
			}
		}


		$select1=mysqli_query($conexion,"SELECT idproducto from producto WHERE nombre='$nombre'");
		while($s1=mysqli_fetch_array($select1)){$idproductos1=$s1['idproducto'];}
			echo "id producto: ".$idproductos1;
		// Asegúrate de que $conexion esté correctamente conectado antes de este código.

		for ($b = 0; $b <= 8; $b++) {
			// Construir el nombre de la clave que esperamos en el array $_FILES
			$keys1 = $b === 0 ? 'imagen' : 'imagen' . $b;
		
			// Comprobar si la imagen existe en el array $_FILES
			if (isset($_FILES[$keys1]) && !empty($_FILES[$keys1])) {
				$file = $_FILES[$keys1];
		
				// Obtener la extensión y el nombre del archivo sin extensión
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$nombreArchivo = pathinfo($file['name'], PATHINFO_FILENAME) . "." . $ext;
		
				// Realizar el insert en la base de datos solo con la primera imagen
				$insertQuery = "INSERT INTO imagenes (idimagen, nombreimagen, idproducto) VALUES (00, '$nombreArchivo', $idproductos1)";

				// Ejecutar la consulta
        		if (mysqli_query($conexion, $insertQuery)) {
            		echo "$keys1 insertado exitosamente.<br>";
        		} else {
            		echo "Error al insertar $keys1: " . mysqli_error($conexion) . "<br>";
        		}
				
			}
		}

		header("location:categorias.php?genero=$generos&estado=1");
	}
}
if (isset($_POST['agregar']) && !empty($_POST['agregar'])) {
	$idproducto = $_POST['idproducto'];
	$imagen =imagen();
	$consultaImagen = mysqli_query($conexion, "SELECT idimagen FROM imagenes WHERE nombreimagen = '.' and idproducto=$idproducto LIMIT 1");
	if ($row = mysqli_fetch_array($consultaImagen)) {
    	$idimagen = $row['idimagen'];
	} else {
    	echo "No se encontraron imágenes con punto en el nombre.";
	}
	$Actualizar1 = "UPDATE imagenes SET nombreimagen='$imagen' where idimagen=$idimagen";
	$enviar = mysqli_query($conexion, $Actualizar1);
	header("location:producto.php?idproducto=$idproducto"); 
	
}
if (isset($_POST['Modificar']) && !empty($_POST['Modificar'])) {
	
	$nombre = $_POST['nombre'];
	$nombre_anterior = $_POST['nombre_anterior'];
	$nombreImg=imagen();
	$descripcion = $_POST['descripcion'];
	$material = $_POST['material'];
	$destacar=$_POST['destacar'];
	$precio = $_POST['precio'];
	$idestado = $_POST['estado'];
	$generos='';
	if(isset($_POST['nombre_genero'])){
	   foreach($_POST['nombre_genero'] as $selected){
		  $generos=$generos.' '.$selected;
	   }
    }
	if ($nombre!=$nombre_anterior){
	$registros=mysqli_query($conexion,"SELECT nombre from producto WHERE nombre='$nombre'");
	if(mysqli_num_rows($registros)>0){  
			$select=mysqli_query($conexion,"SELECT categorias FROM producto WHERE nombre='$nombre'");
			while($r=mysqli_fetch_array($select)){$nombre_genero=$r['categorias'];}
			header("location:productos.php?genero=$nombre_genero&estado=3");     
		}else{
		  if (!is_null($nombreImg)) {	
			$Actualizar = "UPDATE producto SET nombre='$nombre',material='$material',precio=$precio,descripcion='$descripcion',destacar='$destacar',imagen='$nombreImg',idestado=$idestado,categorias='$generos' WHERE nombre='$nombre_anterior'";
			$enviar = mysqli_query($conexion, $Actualizar);
			header("location:categorias.php?genero=$generos&estado=2");
			
		  }else{
			$Actualizar = "UPDATE producto SET nombre='$nombre',material='$material',precio=$precio,descripcion='$descripcion',destacar='$destacar',idestado=$idestado,categorias='$generos' WHERE nombre='$nombre_anterior'";
			$enviar = mysqli_query($conexion, $Actualizar);
			header("location:categorias.php?genero=$generos&estado=2"); 
		  }
		}
	}else{
		if (!is_null($nombreImg)) {	
			$Actualizar = "UPDATE producto SET nombre='$nombre',material='$material',precio=$precio,descripcion='$descripcion',destacar='$destacar',imagen='$nombreImg',idestado=$idestado,categorias='$generos' WHERE nombre='$nombre_anterior'";
			$enviar = mysqli_query($conexion, $Actualizar);
			header("location:categorias.php?genero=$generos&estado=2");
			
		  }else{
			$Actualizar = "UPDATE producto SET nombre='$nombre',material='$material',precio=$precio,descripcion='$descripcion',destacar='$destacar',idestado=$idestado,categorias='$generos' WHERE nombre='$nombre_anterior'";
			$enviar = mysqli_query($conexion, $Actualizar);
			header("location:categorias.php?genero=$generos&estado=2"); 
		  }
	}
}


if (isset($_POST['delete']) && !empty($_POST['delete'])) {
	
	$idProducto = $_POST['id'];
	$delete=mysqli_query($conexion, "Update producto Set idestado = 2 where idproducto=$idProducto");
	header("location:productos.php?genero=$nombre_genero&estado=4");

}


if (isset($_POST['activar']) && !empty($_POST['activar'])) {
	
	$idProducto = $_POST['id'];
	$delete=mysqli_query($conexion, "Update producto Set idestado = 1 where idproducto=$idProducto");
	header("location:listarproductos.php?pagina=1&est=2&estado=2");

}



?>