<?php

session_start();

include("conexion.php");

$mensaje = "";

if(isset($_POST['ingresar'])){

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = $conexion->prepare("
        SELECT * FROM usuarios
        WHERE usuario = ? AND password = ?
    ");

    $sql->execute([
        $usuario,
        $password
    ]);

    if($sql->rowCount() > 0){

        $datos = $sql->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id'] = $datos['id'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['usuario'] = $datos['usuario'];

        header("Location: index.php");
        exit();

    }else{

        $mensaje = "
        <div class='alert alert-danger'>
            Usuario o contraseña incorrectos.
        </div>";

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Web</title>

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
        }

        .card{
            border:none;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
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

    <!-- Menú -->
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
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="servicios.php">Servicios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">Registrar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Iniciar Sesión</a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Encabezado -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">
                Iniciar Sesión
            </h1>

            <p class="lead">
                Accede a tu cuenta para utilizar los servicios del sistema.
            </p>
        </div>
    </section>

    <!-- Formulario Login -->
    <main class="contenido">

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="col-md-5">

                    <div class="card">
                        <div class="card-body p-4">

                            <h2 class="text-center mb-4">
                                Acceso al Sistema
                            </h2>

                           <?php echo $mensaje; ?>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">
            Usuario
        </label>

        <input
            type="text"
            name="usuario"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">
            Contraseña
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            required
        >
    </div>

    <div class="d-grid mb-3">
        <button
            type="submit"
            name="ingresar"
            class="btn btn-primary"
        >
            Iniciar Sesión
        </button>
    </div>

    <div class="text-center">
        <a href="recuperar.php">
            ¿Olvidaste tu contraseña?
        </a>
    </div>

</form>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Espacio para scroll -->
            <div style="height:400px;"></div>

        </div>

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