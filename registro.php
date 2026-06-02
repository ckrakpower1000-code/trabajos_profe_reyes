<?php

include("conexion.php");

$mensaje = "";

if(isset($_POST['registrar'])){

    if(empty($_POST['g-recaptcha-response'])){

        $mensaje = "
        <div class='alert alert-danger'>
            Debes verificar que eres humano.
        </div>";

    }else{

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $verificar = $conexion->prepare(
            "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?"
        );

        $verificar->execute([$usuario,$correo]);

        if($verificar->rowCount() > 0){

            $mensaje = "
            <div class='alert alert-danger'>
                El usuario o correo ya existe.
            </div>";

        }else{

            $sql = $conexion->prepare("
                INSERT INTO usuarios(nombre,correo,usuario,password)
                VALUES(?,?,?,?)
            ");

            if($sql->execute([
                $nombre,
                $correo,
                $usuario,
                $password
            ])){

                echo "
                <script>
                    alert('Usuario registrado correctamente');
                    window.location='index.php';
                </script>
                ";
                exit;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema Web</title>

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                        <a class="nav-link active" href="registro.php">Registrar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Encabezado -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">
                Registro de Usuarios
            </h1>

            <p class="lead">
                Completa el formulario para crear una cuenta.
            </p>
        </div>
    </section>

    <!-- Formulario -->
    <main class="contenido">

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body p-4">

                            <h2 class="text-center mb-4">
                                Crear Cuenta
                            </h2>

<form method="POST">

    <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input
            type="text"
            name="nombre"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Correo Electrónico</label>
        <input
            type="email"
            name="correo"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input
            type="text"
            name="usuario"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input
            type="password"
            name="password"
            class="form-control"
            required
        >
    </div>

<div class="mb-3">
    <div class="g-recaptcha" data-sitekey="6LfyjQktAAAAAGUPbbiaJb1lbXWXFMcowFe3kZkb"></div>
</div>

<div class="d-grid">
    <button type="submit" name="registrar" class="btn btn-primary">
        Registrarse
    </button>
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