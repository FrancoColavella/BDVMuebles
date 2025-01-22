<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Como comprar</title>
    <link rel="stylesheet" href="../public/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/estilos.css">
    <style>
        /* Asegura que html y body ocupen toda la altura del viewport */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Contenedor principal para empujar el footer al fondo */
        .content {
            flex: 1; /* Toma el espacio disponible entre header y footer */
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #212529;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php require("includes/header.php"); ?>

    <!-- Contenido principal con clase .content -->
    <div class="content">
        <div class="container">
            <div class="row justify-content-around mt-3">
                <div class="col-12">
                    <p class="text-center descripNos" style="color:black; font-family: Latin Modern Roman; font-style: oblique;">
                        <strong>Como comprar</strong>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Podes realizar la compra directamente por la tienda agregando al carrito los productos que quieras,
                            y luego eligiendo el medio de pago que desees utilizar. Puede ser tarjeta de crédito (tenes 3 cuotas sin interés),
                            tarjeta de débito, transferencia o depósito bancario, y en efectivo (a acordar con nosotros directamente por nuestro
                            local en Castelar, acordate que tenes un 20% off abonando con este medio de pago).
                        </p>
                        <p>
                            Muchos artículos ya se encuentran en stock. Si tenes dudas antes de realizar la compra, sea por stock o fecha de envío,
                            contáctanos directamente al WhatsApp que está en la tienda. A la brevedad resolveremos todas tus dudas/consultas.
                        </p>
                        <p>
                            Otros artículos se realizan a pedido. Los mismos pueden tener una demora de 10 días aprox. En caso de tener
                            disponibilidad inmediata, coordinaremos para el retiro o envío.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require("includes/footer.php"); ?>
</body>

</html>
