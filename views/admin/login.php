<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="../../css/style_login.css">

<?php
include(__DIR__ . '/../../class/class_db/class_db.php');
include(__DIR__ . '/../../class/class_usuarios/class_usuario_dal.php');

if (isset($_POST['submit'])) {
    $id = $_POST['username'];
    $pass = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];

    // Verifica el captcha
    $secretKey = "6LeWhTMlAAAAALIvtIXWd8nDeS31zyHSda8isyMM";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
    $response = json_decode($response, true);

    if ($response["success"]) {

        $obj_usuario = new catalogo_usuario_dal;
        $result_exis = $obj_usuario->existe_usuario($id, $pass);
        if ($result_exis == 1) {
            session_start();
            $_SESSION['id'] = $id;
            header("Location: ../users/index.php");
            exit();
        } else {
            echo "<script>alert('El usuario o la contraseña son incorrectos')</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa el captcha')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>

<body>
    <form method="POST">

        <img src="../../src/images/SecEd.png" alt="" width="200">

        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">

        <div class="g-recaptcha" data-sitekey="6LeWhTMlAAAAAGp7lWabk7hmOiLk1B7qAh-3m6s_"></div>
        <input type="submit" name="submit" value="Enviar">
    </form>

</body>

</html>