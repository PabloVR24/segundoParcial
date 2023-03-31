<?php
include('./class/class_ticket/class_ticket_dal.php');
$obj_ticket = new catalogo_ticket_dal;
$ticket_number = "1";
$lcurp = "VARP991202HCLLNB05";
$resultado = $obj_ticket->existe_ticket_turno_curp($ticket_number, $lcurp);
$json_tickets = json_encode($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <link rel="stylesheet" href="../css/styles2.css">

    <style>
        body {
            background-color: #e5e5f7;
            opacity: 1;
            background-size: 36px 36px;
            background-image: repeating-linear-gradient(to right, #c4d10d, #c4d10d 1.8px, #e5e5f7 1.8px, #e5e5f7);
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
    <title>API REST - GET ALL</title>
</head>

<body>
    <div class="container">
        <table id="datatable" name="datatable">
            <thead>
                <tr>
                    <th>cve_plan</th>
                    <th>grado</th>
                    <th>clave</th>
                    <th>materia</th>
                    <th>horas_prac</th>
                    <th>horas_teo</th>
                    <th>creditos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($resultado as $curp) { ?>
                        <td>
                            <?php echo $alumno->getCURP(); ?>
                        </td>
                        <td>
                            <?php echo $materia['grado']; ?>
                        </td>
                        <td>
                            <?php echo $materia['clave']; ?>
                        </td>
                        <td>
                            <?php echo $materia['materia']; ?>
                        </td>
                        <td>
                            <?php echo $materia['horas_prac']; ?>
                        </td>
                        <td>
                            <?php echo $materia['horas_teo']; ?>
                        </td>
                        <td>
                            <?php echo $materia['creditos']; ?>
                        </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>