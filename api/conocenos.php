<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./estilos.css">
    <title>Un poco de nosotros</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        /* Asegura que el contenido ocupe todo el alto de la pantalla */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1; /* Hace que este contenedor ocupe el espacio disponible */
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #212529;
            color: #fff;
        }

        .descripNos {
            font-size: 2.5rem;
            font-family: 'Times New Roman', serif;
            font-style: italic;
            margin-bottom: 30px;
        }

        img {
            display: block;
            margin: 0 auto; /* Centra la imagen */
        }
    </style>
</head>

<body>
    <?php require("header.php"); ?>

    <div class="content">
        <div class="container">
            <div class="row justify-content-around mt-3">
                <div class="col-12">
                    <p class="text-center descripNos"style="color:black;font-family:Latin Modern Roman;font-style: oblique;"><strong>Nosotros</strong></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p>Hola!! Gracias por visitarnos!</p>
                        <p>Somos Mauro y Naty, una pareja emprendedora de corazón, juntos creamos BDV Muebles con el propósito de llevar Deco buena, bonita y barata a precios súper accesibles!</p>
                        <p>Esa es nuestra misión, que todos puedan decorar cada espacio de sus hogares, oficinas, jardines o el lugar que sea con productos súper bonitos y a precios ganga!</p>
                        <p>Nuestro equipo se conforma de solo dos personas y cada uno es parte FUNDAMENTAL de este proyecto que, GRACIAS a USTEDES, crece día a día!</p>
                        <p>Somos muy felices de formar parte de esto tan bonito que se formó y estamos seguros que vamos a seguir mejorando para que se lleven de nosotros siempre la mejor experiencia!</p>
                        <p>Nos vemos pronto!!</p>
                        <p>
                            <i class="fab fa-facebook fa-lg" style="color:#0d47a1"> </i>
                            <a href="https://www.facebook.com/profile.php?id=100082549028265" target="_blank" style="text-decoration:none;">bdvmuebles</a>
                        </p>
                        <p>
                            <i class="fab fa-instagram fa-lg" style="color:#c32aa3"></i>
                            <a href="https://instagram.com/bdvmuebles" target="_blank" style="text-decoration:none;">@bdvmuebles</a>
                        </p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="./imagenes/bdvmuebles.jpeg" class="card-img-top" alt="BDV Muebles" style="width: 530px; height: 600px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p>
    <p>
    <p>

    <?php require("footer.php"); ?>
</body>

</html>
