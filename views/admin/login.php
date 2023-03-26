<?php
include('../class/class_db/class_db.php');
include('../class/class_usuarios/class_usuario_dal.php');

if (isset($_POST['submit'])) {
    $id = $_POST['username'];
    $pass = $_POST['password'];

    $obj_usuario = new catalogo_usuario_dal;
    $result_exis = $obj_usuario->existe_usuario($id, $pass);
    if ($result_exis == 1) {
        session_start();
        $_SESSION['id'] = $id;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('El usuario o la contraseña son incorrectos')</script>";
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
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username">

        <label for="password">Contraseña</label>
        <input type="text" name="password" id="password">

        <input type="submit" name="submit" value="Enviar">
    </form>

</body>

</html>