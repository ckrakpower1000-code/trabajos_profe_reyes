<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

include("conexion.php");

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$mensaje = "";

if(isset($_POST['actualizar'])){

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = $conexion->prepare("
        UPDATE usuarios
        SET usuario = ?, password = ?
        WHERE id = ?
    ");

    if($sql->execute([
        $usuario,
        $password,
        $_SESSION['id']
    ])){

        $_SESSION['usuario'] = $usuario;

        $mensaje = "
        <div class='alert alert-success'>
            Perfil actualizado correctamente.
        </div>";

    }else{

        $mensaje = "
        <div class='alert alert-danger'>
            Error al actualizar el perfil.
        </div>";

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Sistema Web</title>

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
                        <a class="nav-link active" href="perfil.php">Perfil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="index.php?logout=1">
                            Cerrar Sesión
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- Encabezado -->
    <section class="hero">
        <div class="container">

            <h1 class="display-4 fw-bold">
                Mi Perfil
            </h1>

            <p class="lead">
                Información de la cuenta del usuario.
            </p>

        </div>
    </section>

    <!-- Contenido -->
    <main class="contenido">

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="col-md-6">

                    <div class="card">

                        <div class="card-body p-4">

                            <h2 class="text-center mb-4">
    Mi Perfil
</h2>

<?php echo $mensaje; ?>

<form method="POST">

    <div class="mb-3">

        <label class="form-label">
            Nombre
        </label>

        <input
            type="text"
            class="form-control"
            value="<?php echo $_SESSION['nombre']; ?>"
            disabled
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Usuario
        </label>

        <input
            type="text"
            name="usuario"
            class="form-control"
            value="<?php echo $_SESSION['usuario']; ?>"
            required
        >

    </div>

    <div class="mb-3">

        <label class="form-label">
            Nueva Contraseña
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            required
        >

    </div>

    <div class="d-grid gap-2">

        <button
            type="submit"
            name="actualizar"
            class="btn btn-success"
        >
            Guardar Cambios
        </button>

        <a href="index.php" class="btn btn-primary">
            Volver al Inicio
        </a>

        <a href="index.php?logout=1" class="btn btn-danger">
            Cerrar Sesión
        </a>

    </div>

</form>

                        </div>

                    </div>

                </div>

            </div>

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