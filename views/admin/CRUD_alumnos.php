<?php
include("../../includes/navbar.php");
include("../../class/class_alumno/class_alumno_dal.php");


$obj_ticket = new catalogo_alumno_dal;
$resultado2 = $obj_ticket->obtener_lista_alumno();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <title>CRUD: ALUMNOS</title>
</head>

<script>
    $(document).ready(function() {
        $("#dataTable").DataTable();
    });
</script>

<body>

    <table id="dataTable" class="display">
        <thead>
            <tr>
                <th>CURP</th>
                <th>NOMBRE</th>
                <th>MATERNO</th>
                <th>PATERNO</th>
                <th>TELEFONO</th>
                <th>CELULAR</th>
                <th>EMAIL</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado2 as $registro) { ?>
                <tr>
                    <td>
                        <?php echo $registro->getCURP() ?>
                    </td>
                    <td>
                        <?php echo $registro->getNOMBRE() ?>
                    </td>
                    <td>
                        <?php echo $registro->getAPELLIDO_PAT() ?>
                    </td>
                    <td>
                        <?php echo $registro->getAPELLIDO_MAT() ?>
                    </td>
                    <td>
                        <?php echo $registro->getTELEFONO() ?>
                    </td>
                    <td>
                        <?php echo $registro->getCELULAR() ?>
                    </td>
                    <td>
                        <?php echo $registro->getEMAIL() ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary">Primary</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning">Warning</button>
                    </td>
                    <td>
                    <button type="button" class="btn btn-danger">Danger</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-success">Success</button>
</body>

</html>