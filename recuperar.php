<?php

include("conexion.php");

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensaje = "";

if(isset($_POST['enviar'])){

    $correo = $_POST['correo'];

    $sql = $conexion->prepare("
        SELECT * FROM usuarios
        WHERE correo = ?
    ");

    $sql->execute([$correo]);

    if($sql->rowCount() > 0){

        $datos = $sql->fetch(PDO::FETCH_ASSOC);

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'ckrakpower1000@gmail.com';

            $mail->Password = 'xyvg ztpr uxmk ylcm';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(
                'ckrakpower1000@gmail.com',
                'Sistema Web'
            );

            $mail->addAddress($correo);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $mail->Subject = 'Recuperación de contraseña';

            $mail->Body = '
                <h2>Recuperación de contraseña</h2>

                <p>Hola '.$datos['nombre'].'</p>

                <p>Se solicitó un cambio de contraseña para tu cuenta.</p>

                <p>
                    <a href="http://localhost/desarollo_web/cambiar_password.php?id='.$datos['id'].'">
                        Cambiar contraseña
                    </a>
                </p>
            ';

            $mail->send();

            $mensaje = "
            <div class='alert alert-success'>
                Correo enviado correctamente.
            </div>";

        }catch(Exception $e){

            $mensaje = "
            <div class='alert alert-danger'>
                Error al enviar correo:
                ".$mail->ErrorInfo."
            </div>";

        }

    }else{

        $mensaje = "
        <div class='alert alert-danger'>
            El correo no existe en el sistema.
        </div>";

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f5f5f5;">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">
                        Recuperar Contraseña
                    </h2>

                    <?php echo $mensaje; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Correo Electrónico
                            </label>

                            <input
                                type="email"
                                name="correo"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                name="enviar"
                                class="btn btn-primary"
                            >
                                Enviar Correo
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>