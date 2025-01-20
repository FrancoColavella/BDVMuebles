<?php

require("conexion.php");

$id_usuario = 0;
$nombre_usuario = "";
session_start();
if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
    $id_usuario = $_SESSION['login'];
    $nombre_usuario = $_SESSION['usuario'];
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Inicio BDVMUEBLES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <style>
        .row {
            padding: 0px;
            margin: 0px;
        }

        .menu a {
            color: white;
            text-decoration: none;
        }

        .login li {
            padding: 20px;
        }
        * {
				margin:0px;
				padding:0px;
			}
			
			#header {
				margin:auto;
				width:500px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav {
				width:500px; /*Le establecemos un ancho*/
				margin:0 auto; /*Centramos automaticamente*/
			}

			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:#000;
				color:#fff;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-12" style="background:#121212">
            <div class="row contBackHeader">
                <div class="col-md-3" style="padding-top:15px"><a class="navbar-brand" href="index.php"><img src="logo2.png" style="width:200px;height: 70px;border-radius: 50px"></a>
                </div>
                <div class="col-md-5" style="padding-top:35px;">
                    <form action="buscador.php?pagina=1" method="POST">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select style="width:160px;background:black;color:white" class="form-control" id="selectTipo" name="genero">
                                <?php 
                                    $select=mysqli_query($conexion,"SELECT * FROM categoria");
                                    while($r=mysqli_fetch_array($select)){ ?>
                                    <option><?php echo $r['nombrecategoria'];?></option>
                                    <?php } ?>                                   
                                </select>
                            </div>
                            <input id="nombre" name="nombre" style="background:black;color:white" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Buscar productos">
                                <div class="input-group-append">
                                    <button style="border-color: white" class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4" style="padding-top:15px;">
                    <nav class="navbar navbar-expand-lg " style="float:right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto login">
                                <?php if ($id_usuario == 0) : ?>
                                    <li class="nav-item active">
                                        <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#ingresar" onclick="ingresar();">Iniciar Sesión</a>
                                    </li>
                                <?php else : ?>

                                    <li class="nav-item">
                                        <a class="btn btn-light user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-user-alt"></i> <?php echo $nombre_usuario;?>
                                        </a>
                                                   
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <!--<form method="POST" action="listarpeliculas.php">-->
                                                            <a href="listarproductos.php?pagina=1&est=1" onMouseover="this.style.background='#B7B7B7'" onMouseout="this.style.background='white'" class="dropdown-item"><i class='fa fa-list-alt'></i> Listado Productos</a>
                                                        <!--</form>-->
                                            <form action="logout.php" method="POST">
                                                <button type="submit" onMouseover="this.style.background='#B7B7B7'" onMouseout="this.style.background='white'" class="dropdown-item" name="borrar"><i class='fa fa-sign-out'></i> Cerrar Sesión</button>
                                            </form>
                                        </div>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-2" style="background:#121212">
                    <div id="header">
			            <ul class="nav">
				            <li><a href="index.php"><i class="fas fa-stream"></i></a>
					            <ul>
						            <li><a href="categorias.php">Productos</a>
                                        <ul>
                                        <?php 
                                            $select=mysqli_query($conexion,"SELECT * FROM categoria");
                                            while($r=mysqli_fetch_array($select)){
                                        ?>
						                    <li><a href="productos.php?genero=<?php echo $r['nombrecategoria'];?>"><?php echo $r['nombrecategoria'];?></a></li>
                                            <?php }?>
                                        </ul>
                                    </li>
						            <li><a href="Conocenos.php">Un poco de nosotros</a></li>
                                    <li><a href="Comprar.php">Como comprar</a></li>
                                    <li><a href="Pfrecuentes.php">Preguntas frecuentes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div data-backdrop="static" class="modal fade" id="ingresar">
                <div class="col-md-12 modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Iniciar Sesión</h4>
                            <button type="button" class="close" data-dismiss="modal">X</button>
                        </div>
                        <div class="col-md-12" style="background:#e0e0e0">
                            <div class="modal-body">
                                <form action="login.php" method="POST">
                                    <div class="form-group" id="user-group">
                                        <label for="user">Usuario</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario" onkeypress="return check(event)" placeholder="Ingrese su usuario" require>
                                    </div>
                                    <div class="form-group" id="password-group">
                                        <label for="contra">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasenia" id="contrasenia" onkeypress="return check(event)" placeholder="Ingrese su contraseña" require>
                                    </div>
                                    <div align="center"><a style="color:black;text-decoration:none" data-toggle="modal" href="#" data-target="#recuperar">¿Olvidaste tu contraseña?</a></div>
                                    <div align="center" class="form-group">
                                        <button style="margin-top:7%;width:50%" name="ingresar" value="ingresar" type="submit" class="btn btn-light">Ingresar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end #iniciar-->
        </div>
        <div data-backdrop="static" class="modal fade" id="recuperar">
            <div class="col-md-12 modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Recuperar Contraseña</h4>
                        <button type="button" class="close" data-dismiss="modal">X</button>
                    </div>
                    <div class="col-md-12" style="background:#e0e0e0">
                        <div class="modal-body">
                            <form action="recuperarContra.php" method="POST">
                                <div class="form-group" id="user-group">
                                    <label for="user">Ingrese su email</label>
                                    <input type="email" class="form-control" name="mail" id="mail" require placeholder="Ingrese su email">
                                </div>

                                <button style="margin-top:7%;width:50%" name="buscar" value="buscar" type="submit" class="btn btn-light">Buscar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="jquery.min.js"></script>
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script>
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
    </script>
</body>

</html>

