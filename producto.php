<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <style>

        .title h1 {
            text-align: center;
            color: #333;
        }

        .content {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
        }

        .carousel-container {
            flex: 1;
            margin-right: 20px;
        }

        .carousel-inner img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .details-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .price {
            font-size: 1.5em;
            color: #e63946;
            margin-bottom: 10px;
        }

        .specs,
        .details {
            font-size: 1em;
            color: #555;
            margin-bottom: 10px;
        }

        .specs strong,
        .details strong {
            color: #333;
        }

        .add-image {
            margin-top: 20px;
        }

        .add-image button,
        .contact-button a {
            background-color: #333;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-image button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .contact-button {
            margin-top: 10px;
        }

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
        if (isset($_GET['idproducto'])) {
            $idproducto = $_GET['idproducto'];
        }
        require("header.php");
        $consulta = mysqli_query($conexion, "SELECT * FROM producto where idproducto=$idproducto");
        $consulta2 = mysqli_query($conexion, "SELECT * FROM imagenes where idproducto=$idproducto and nombreimagen !='.'");
        $imageCount = mysqli_num_rows($consulta2);

        while ($r = mysqli_fetch_array($consulta)) { 
            $nombre = $r['nombre'];
            $material = $r['material'];
            $precio = $r['precio'];
            $descripcion = $r['descripcion'];
        }

        $loggedIn = isset($_SESSION['usuario']);
    ?>
    <div class="container" style="padding-top:100px">
        <div class="title"><h1><?php echo $nombre; ?></h1></div>
        <div class="content">
            <div class="carousel-container">
                <div align="center" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $active="active";
                            while ($ri=mysqli_fetch_array($consulta2)) {
                        ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <img src="ImagenesOriginales/<?php echo $ri['nombreimagen']; ?>" class="card-img-top">
                        </div>
                        <?php 
                            $active = "";
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
            <div class="details-container">
                <div class="price"><strong>Precio:</strong> <?php echo "$" . $precio; ?></div>
                <div class="specs"><strong>Material:</strong> <?php echo $material; ?></div>
                <div class="details"><strong>Descripción:</strong> <?php echo $descripcion; ?></div>
                <?php if ($loggedIn) { ?>
                    <div class="add-image">
                        <?php if ($imageCount < 9) { ?>
                            <form action="ABM.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="idproducto" id="idproducto" value="<?php echo $idproducto; ?>">
                                <input type="file" name="imagen" accept="image/*" id="imagen" required>
                                <button type="submit" value="agregar" name="agregar">Agregar Imagen</button>
                            </form>
                        <?php } else { ?>
                            <button disabled>No se pueden agregar más imágenes</button>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="contact-button">
                    <a href="https://wa.me/5491157534151?text=Me%20interesa%20este%20producto:%20<?php echo urlencode($nombre); ?>" target="_blank">Contáctanos</a>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
</body>
</html>
