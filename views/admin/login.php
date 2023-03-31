<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="../../css/style_login.css">

<?php
include(__DIR__ . '/../../class/class_db/class_db.php');
include(__DIR__ . '/../../class/class_usuarios/class_usuario_dal.php');
include(__DIR__ . '/../../includes/sweetalert.php');

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
            header("Location: ../admin/index.php");
            exit();
        } else {
            echo ('<script>alert("Usuario o Contraseña Incorrectos")</script>');
        }
    } else {
        echo ('<script>alert("Por favor, Completa el CAPTCHA")</script>');
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
    <form id="forms" method="POST">

        <img src="../../src/images/SecEd.png" alt="" width="200">

        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">

        <div class="g-recaptcha" data-sitekey="6LeWhTMlAAAAAGp7lWabk7hmOiLk1B7qAh-3m6s_"></div>
        <input type="submit" name="submit" value="Enviar">
    </form>

</body>

<script>
    const formulario = document.getElementById("forms");
    const btnSubmit = document.getElementById("btnSubmit");
    let varia = "";
    let variable;

    formulario.addEventListener("submit", (e) => {
        messages = []

        let patUser = document.getElementById("username").value.trim();

        if (patUser.length == 0) {
            messages.push("FALTANTE: Nombre de Usuario");
        }

        let patPassword = document.getElementById("password").value.trim();
        if (patPassword.length == 0) {
            messages.push("FALTANTE: Contraseña");
        }


        if (messages.length > 0) {
            Swal.fire({
                icon: "info",
                title: "Error en campos",
                text: messages.join(" --- "),
                footer: "Complete o verifique los campos mencionados",
            });
            e.preventDefault();
        }
    });
</script>

</html>