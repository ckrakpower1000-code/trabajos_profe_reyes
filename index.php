<?php

session_start();

if(isset($_GET['logout'])){

    $_SESSION = [];

    session_destroy();

    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        .hero{
            background:#0d6efd;
            color:white;
            padding:80px 20px;
            text-align:center;
        }

        .contenido{
            flex:1;
            min-height:600px;
        }

        .card{
            border:none;
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        footer{
            margin-top:auto;
        }

        footer a{
            color:white;
            text-decoration:none;
            margin:0 10px;
        }

        footer a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

    <!-- Menú de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand fw-bold" href="index.php">
                Sistema Web
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="servicios.php">Servicios</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>

                    <?php if(isset($_SESSION['id'])){ ?>

    <li class="nav-item">
        <a class="nav-link" href="perfil.php">
            Perfil
        </a>
    </li>

<li class="nav-item">
    <a class="nav-link text-danger" href="index.php?logout=1">
        Cerrar Sesión
    </a>
</li>

<?php } else { ?>

    <li class="nav-item">
        <a class="nav-link" href="registro.php">
            Registrar
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="login.php">
            Iniciar Sesión
        </a>
    </li>

<?php } ?>


                </ul>

            </div>

        </div>
    </nav>


    <!-- Encabezado -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">
                Sistema Web
            </h1>

            <p class="lead">
                Ejemplo de navegación y validación de datos.
            </p>
        </div>
    </section>

    <!-- Contenido -->
    <main class="contenido">

        <section class="container py-5">

    <?php if(isset($_SESSION['id'])){ ?>

<div class="container mt-4">

    <div class="alert alert-success shadow">

        <h4>
            Bienvenido,
            <?php echo $_SESSION['nombre']; ?>
        </h4>

        <p class="mb-0">
            Usuario:
            <strong>
                <?php echo $_SESSION['usuario']; ?>
            </strong>
        </p>

    </div>

</div>

<?php } ?>
            <h2 class="text-center mb-5">
                Validación de Datos
            </h2>

            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h3>Frontend</h3>
                            <p>
                                Verifica que los datos ingresados tengan el formato correcto
                                antes de enviarlos al servidor mediante HTML, CSS y JavaScript.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h3>Backend</h3>
                            <p>
                                Comprueba la información recibida desde el servidor para evitar
                                datos incorrectos, ataques o registros inválidos.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h3>Usuarios Humanos</h3>
                            <p>
                                Se utilizan mecanismos como CAPTCHA y verificaciones para
                                confirmar que quien interactúa con el sistema es una persona real.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">

        <div class="container text-center">

            <div class="mb-3">

                <a href="buzon.php">Buzón</a>

                <a href="ayuda.php">Ayuda</a>

                <a href="contacto.php">Contáctanos</a>

                <a href="mapa.php">Mapa del Sitio</a>

                <a href="recuperar.php">Recuperar Contraseña</a>

                <a href="chat.php">Chat</a>

            </div>

            <hr class="border-secondary">

            <p class="mb-0">
                © 2026 Sistema Web - Todos los derechos reservados.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>