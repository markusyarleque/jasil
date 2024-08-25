<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>/libs/css/main.css" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
        }

        #footer_404 {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Background images for different screen sizes */
        @media only screen and (min-width: 1920px) {
            body {
                background-image: url('uploads/404-large.jpg');
                /* Replace with your 4K image */
            }
        }

        @media only screen and (max-width: 1919px) {
            body {
                background-image: url('uploads/404-medium.jpg');
                /* Replace with your 1920x1080 image */
            }
        }

        @media only screen and (max-width: 768px) {
            body {
                background-image: url('uploads/404-small.jpg');
                /* Replace with your mobile image */
            }
        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>

<body>
    <!--<div class="container">
        <h1>Error</h1>
        <p>Lo sentimos, la página que buscas no se ha encontrado.</p>
    </div>-->
    <div id="footer_404">
        <a href="javascript:void(0);" onclick="goBack()">
            <i class="glyphicon glyphicon-chevron-left"></i>
            Volver
        </a>
    </div>
</body>

</html>