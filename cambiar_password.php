<?php

include("conexion.php");

if(!isset($_GET['id'])){

    header("Location: login.php");
    exit();

}

$id = $_GET['id'];

$mensaje = "";

if(isset($_POST['guardar'])){

    $password = $_POST['password'];

    $sql = $conexion->prepare("
        UPDATE usuarios
        SET password = ?
        WHERE id = ?
    ");

    if($sql->execute([$password, $id])){

        echo "
        <script>
            alert('Contraseña actualizada correctamente');
            window.location='login.php';
        </script>
        ";
        exit();

    }else{

        $mensaje = "
        <div class='alert alert-danger'>
            Error al actualizar la contraseña.
        </div>";

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .contenedor{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .card{
            width:500px;
            border:none;
            box-shadow:0 0 15px rgba(0,0,0,.1);
        }

    </style>

</head>
<body>

<div class="contenedor">

    <div class="card">

        <div class="card-body p-4">

            <h2 class="text-center mb-4">
                Cambiar Contraseña
            </h2>

            <?php echo $mensaje; ?>

            <form method="POST">

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

                <div class="d-grid">

                    <button
                        type="submit"
                        name="guardar"
                        class="btn btn-success"
                    >
                        Guardar Contraseña
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>