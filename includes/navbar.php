<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../admin/login.php");
    exit();
} else {
    include(__DIR__ . '/../class/class_usuarios/class_usuario_dal.php');

    $obj_usuario = new catalogo_usuario_dal;
    $resultado = $obj_usuario->datos_por_id($_SESSION['id']);
    if ($resultado == null) {
        echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
    } else {
        $nombre = ($resultado->getNOMBRE());
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

<style>
    .navbar {
        background-color: #1c121f;
        color: white;
        height: 80px;
    }

    .navbar-brand {
        color: white;
    }

    .nav-link {
        color: white;
    }

    .nav-link:hover {
        background-color: #7D5A8C;
        color: white;
    }

    .close-sesion:hover {
        color: white;
        background-color: red;
    }

    .dropdown-menu {
        background-color: #7D5A8C;
    }

    .dropdown-item:hover {
        background-color: #5a3c62;
        color: white;
    }
</style>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" style="list-style: none; margin-left:80px" href="../../index.php">TICKET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../admin/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/ticket_atention.php">Atencion a Ticket</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catalogos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../admin/crud_alumnos.php">Alumnos</a></li>
                        <!-- <li><a class="dropdown-item" href="../admin/crud_usuarios.php">Usuarios</a></li> -->
                        <li><a class="dropdown-item" href="../admin/crud_niveles.php">Niveles</a></li>
                        <li><a class="dropdown-item" href="../admin/crud_municipios.php">Municipios</a></li>
                        <li><a class="dropdown-item" href="../admin/crud_asuntos.php">Asuntos</a></li>
                        <li><a class="dropdown-item" href="../admin/crud_ticket.php">TICKET</a></li>
                    </ul>
                </li>
            </ul>
            <li class="nav-item dropdown" style="list-style: none; margin-right:80px">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $nombre ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item close-sesion" href="../includes/logout.php">Cerrar Sesión</a></li>
                </ul>
            </li>
        </div>
    </div>
</nav>