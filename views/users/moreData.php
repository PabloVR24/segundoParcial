<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Datos</title>

    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet" />
</head>

<?php
require_once(__DIR__ . '/../../class/alumn_validation.php');
require_once(__DIR__ . '/../../class/class_alumno/class_alumno_dal.php');
$lcurp = $_GET['lcurp'] ?? '';
$fname = $_GET['fname'] ?? '';
$mes = $_GET['mes'] ?? '';
$mes1 = $_GET['mes1'] ?? '';
$mes2 = $_GET['mes2'] ?? '';
$fecha = $_GET['fecha'] ?? '';
?>

<body>
    <div class="container">
        <form id="forms" method="post" action="">
            <h2>Completar Datos</h2>
            <br>
            <div class="wrapper">
                <div class="box">
                    <div class="box">
                        <input class="whiteText" type='text' name='lCurp' id="lCurp" value="<?php echo isset($_POST["lCurp"]) ? $_POST["lCurp"] : "$lcurp"; ?>" />
                        <label for="lCurp">CURP:</label>
                        <?php if (!empty($error_lcurp)) { ?>
                            <span class="error">
                                <?php echo $error_lcurp; ?>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="box">
                        <input class="whiteText" type="text" name="name" id="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>" />
                        <label for="name">Nombre</label>
                        <?php if (!empty($error_name)) { ?>
                            <span class="error">
                                <?php echo $error_name; ?>
                            </span>
                        <?php } ?>

                    </div>
                    <div class="box">
                        <input class="whiteText" type="text" name="firstName" id="firstName" value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : ""; ?>" />
                        <label for="firstName">Ap. Paterno</label>
                        <?php if (!empty($error_firstName)) { ?>
                            <span class="error">
                                <?php echo $error_firstName; ?>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="box">
                        <input class="whiteText" type="text" name="lastName" id="lastName" value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : ""; ?>" />
                        <label for="lastName">Ap. Materno</label>
                        <?php if (!empty($error_lastName)) { ?>
                            <span class="error">
                                <?php echo $error_lastName; ?>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="box">
                        <input class="whiteText" type="tel" name="tel" id="tel" value="<?php echo isset($_POST[" tel "]) ? $_POST[" tel "] : ""; ?>" />
                        <label for="tel">Telefono:</label>
                        <?php if (!empty($error_tel)) { ?>
                            <span class="error">
                                <?php echo $error_tel; ?>
                            </span>
                        <?php } ?>

                    </div>
                    <div class="box">
                        <input class="whiteText"type="tel" name="cel" id="cel" value="<?php echo isset($_POST[" cel "]) ? $_POST["cel "] : ""; ?>" />
                        <label for="cel">Celular:</label>
                        <?php if (!empty($error_cel)) { ?>
                            <span class="error">
                                <?php echo $error_cel; ?>
                            </span>
                        <?php } ?>

                    </div>
                    <div class="box">
                        <input class="whiteText" type="email" name="mail" id="mail" value="<?php echo isset($_POST[" mail "]) ? $_POST["mail "] : ""; ?>" />
                        <label for="mail">e-mail</label>
                        <?php if (!empty($error_mail)) { ?>
                            <span class="error">
                                <?php echo $error_mail; ?>
                            </span>
                        <?php } ?>

                    </div>

                    <div class="wrapper">
                        <div class="box">
                            <input type="submit" id="btnSubmit" value="Enviar" />
                        </div>
                    </div>
                    
                    <input hidden type="text" name="fname" id="fname" value="<?php echo $fname?>">
                    <input hidden type="text" name="mes" id="mes" value="<?php echo $mes?>">
                    <input hidden type="text" name="mes1" id="mes1" value="<?php echo $mes1?>">
                    <input hidden type="text" name="mes2" id="mes2" value="<?php echo $mes2?>">
                    <input hidden type="text" name="fecha" id="fecha" value="<?php echo $fecha?>">
        </form>
    </div>
</body>

<script>
    const formulario = document.getElementById("forms");
    const btnSubmit = document.getElementById("btnSubmit");
    let varia = "";
    let variable;

    formulario.addEventListener("submit", (e) => {
        let messages = [];

        let expName = /^[a-zA-Z ]{3,30}?$/;

        let patName = document.getElementById("name").value.trim();
        let patfirstName = document.getElementById("firstName").value.trim();
        let patlastName = document.getElementById("lastName").value.trim();

        let variables = ["patFname", "patName", "patfirstName", "patlastName"];

        for (let i = 0; i < variables.length; i++) {
            if (variables[i] === "patName") {
                varia = "Nombre.";
                variable = patName;
            } else if (variables[i] === "patfirstName") {
                varia = "Apellido P.";
                variable = patfirstName;
            } else if (variables[i] === "patlastName") {
                varia = "Apellido M.";
                variable = patlastName;
            }
            validarTexto(variable, varia);
        }

        function validarTexto(variable, msg) {
            if (variable === "") {
                messages.push("FALTANTE: " + msg);
            } else if (!expName.test(variable)) {
                messages.push("INVALIDO: " + msg);
            }
        }

        let patTel = document.getElementById("tel").value.trim();
        let expTel = /^(\d{10})$/;

        if (!expTel.test(patTel)) {
            messages.push("INVALIDO: Telefono");
        } else if (patTel.length == 0) {
            messages.push("FALTANTE: Telefono");
        }

        let patCel = document.getElementById("cel").value.trim();

        if (!expTel.test(patCel)) {
            messages.push("INVALIDO: Celular");
        } else if (patCel.length == 0) {
            messages.push("FALTANTE: Celular");
        }

        let patMail = document.getElementById("mail").value.trim();
        let expMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (!expMail.test(patMail)) {
            messages.push("INVALIDO: email");
        } else if (patMail.length == 0) {
            messages.push("FALTANTE: email");
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