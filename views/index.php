<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parcial 2 - Desarrollo Web</title>
    <script defer src="../js/validate.js"></script>
    <!---<link rel="stylesheet" href="../css/styles.css">--->
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css
" rel="stylesheet" />

</head>

<?php
include('../class/server_validation.php');
include('../class/class_ticket/class_ticket_dal.php');
include('../class/class_asunto/class_asunto_dal.php');
include('../class/class_municipio/class_municipio_dal.php');
include('../class/class_nivel/class_nivel_dal.php');
?>

<body>
    <div class="container">
        <h2>Ticket de Turno</h2>
        <form id="forms" method="post" action="">
            <div class="wrapper">
                <div class="box">
                    <input type="text" name="fname" id="fname" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ""; ?>" />
                    <label for="fname">Nombre completo de quien realizará el trámite:</label>
                    <?php if (!empty($error_fname)) { ?>
                        <span class="error"><?php echo $error_fname; ?></span>
                    <?php } ?>
                </div>
                <div class="box">
                    <input type="text" name="lCurp" id="lCurp" value="<?php echo isset($_POST["lCurp"]) ? $_POST["lCurp"] : ""; ?>" />
                    <label for="lCurp">CURP:</label>
                    <?php if (!empty($error_lcurp)) { ?>
                        <span class="error"><?php echo $error_lcurp; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="wrapper">
                <div class="box">
                    <input type="text" name="name" id="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>" />
                    <label for="name">Nombre</label>
                    <?php if (!empty($error_name)) { ?>
                        <span class="error"><?php echo $error_name; ?></span>
                    <?php } ?>

                </div>
                <div class="box">
                    <input type="text" name="firstName" id="firstName" value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : ""; ?>" />
                    <label for="firstName">Ap. Paterno</label>
                    <?php if (!empty($error_firstName)) { ?>
                        <span class="error"><?php echo $error_firstName; ?></span>
                    <?php } ?>
                </div>
                <div class="box">
                    <input type="text" name="lastName" id="lastName" value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : ""; ?>" />
                    <label for="lastName">Ap. Materno</label>
                    <?php if (!empty($error_lastName)) { ?>
                        <span class="error"><?php echo $error_lastName; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="wrapper">
                <div class="box">
                    <input type="tel" name="tel" id="tel" value="<?php echo isset($_POST["tel"]) ? $_POST["tel"] : ""; ?>" />
                    <label for="tel">Telefono:</label>
                    <?php if (!empty($error_tel)) { ?>
                        <span class="error"><?php echo $error_tel; ?></span>
                    <?php } ?>

                </div>
                <div class="box">
                    <input type="tel" name="cel" id="cel" value="<?php echo isset($_POST["cel"]) ? $_POST["cel"] : ""; ?>" />
                    <label for="cel">Celular:</label>
                    <?php if (!empty($error_cel)) { ?>
                        <span class="error"><?php echo $error_cel; ?></span>
                    <?php } ?>

                </div>
                <div class="box">
                    <input type="email" name="mail" id="mail" value="<?php echo isset($_POST["mail"]) ? $_POST["mail"] : ""; ?>" />
                    <label for="mail">e-mail</label>
                    <?php if (!empty($error_mail)) { ?>
                        <span class="error"><?php echo $error_mail; ?></span>
                    <?php } ?>

                </div>
            </div>

            <div class="wrapper">
                <div class="box">
                    <?php
                    $obj_lista_niveles = new catalogo_nivel_dal;
                    $result_nivel = $obj_lista_niveles->obtener_lista_niveles();

                    if ($result_nivel == null) {
                        echo '<h2> No se encontraron Niveles </h2>';
                    } else {
                    ?>
                        <select name="mes" id="mes" value="<?php echo isset($_POST["mes"]) ? $_POST["mes"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_nivel as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->getID_NIVEL() ?>"><?= $value->getNOMBRE_NIVEL() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>
                    <label for="mes">Nivel al que desea ingresar o que ya cursa el alumno:
                    </label>
                    <br>
                    <?php if (!empty($error_mes)) { ?>
                        <span class="error"><?php echo $error_mes; ?></span>
                    <?php } ?>
                </div>

                <div class="box">
                    <?php
                    $obj_lista_asuntos = new catalogo_asunto_dal;
                    $result_asuntos = $obj_lista_asuntos->obtener_lista_ASUNTO();

                    if ($result_asuntos == null) {
                        echo '<h2> No se encontraron Asuntos </h2>';
                    } else {
                    ?>
                        <select name="mes1" id="mes1" value="<?php echo isset($_POST["mes1"]) ? $_POST["mes1"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_asuntos as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->GETID_ASUNTO() ?>"><?= $value->getNOMBRE_ASUNTO() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>
                    <label for="mes1">Asunto a tratar:
                    </label>
                    <br>
                    <?php if (!empty($error_mes1)) { ?>
                        <span class="error"><?php echo $error_mes1; ?></span>
                    <?php } ?>
                </div>
            </div>


            <div class="wrapper">
                <div class="box">
                    <?php
                    $obj_lista_municipio = new catalogo_municipio_dal;
                    $result_municipio = $obj_lista_municipio->obtener_lista_municipio();

                    if ($result_municipio == null) {
                        echo '<h2> No se encontraron Municipios </h2>';
                    } else {
                    ?>
                        <select name="mes2" id="mes2" value="<?php echo isset($_POST["mes2"]) ? $_POST["mes2"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_municipio as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->getID_MUNICIPIO() ?>"><?= $value->getNOMBRE_MUNICIPIO() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>
                    <label for="mes2">Municipio:
                    </label>

                    <br>
                    <?php if (!empty($error_mes2)) { ?>
                        <span class="error"><?php echo $error_mes2; ?></span>
                    <?php } ?>
                </div>

                <div class="box">
                    <input type="date" id="fecha" name="fecha" value="<?php echo isset($_POST["fecha"]) ? $_POST["fecha"] : ""; ?>" min="2023-01-01" max="2023-12-31">
                    <label for="fecha">Fecha de Cita:
                    </label>
                    <br>
                    <?php if (!empty($error_fecha)) { ?>
                        <span class="error"><?php echo $error_fecha; ?></span>
                    <?php } ?>
                </div>

            </div>

            <div class="wrapper">
                <div class="box">
                    <input type="submit" id="btnSubmit" value="Enviar" />
                </div>
            </div>
        </form>
    </div>
</body>

</html>