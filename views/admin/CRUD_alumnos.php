<?php
include(__DIR__ . '/../../includes/navbar.php');
$url = "http://localhost:3000/api/alumnos";
$response = file_get_contents($url);
$datos = json_decode($response, true);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD - Alumnos</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../../css/styles-cruds.css">
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#alumnosTable').DataTable({
            responsive: true
        });
    });
</script>

<body>
    <div class="container">
        <div class="CRUD">
            <form>
                <div class="form-gs">

                    <h3>Catalogo: Alumnos</h3>
                    <label for="curp">CURP:</label>
                    <input class="controls" type="text" id="curp" name="curp">

                    <label for="nombre">Nombre:</label>
                    <input class="controls" type="text" id="nombre" name="nombre">

                    <label for="apellido_pat">Apellido Paterno:</label>
                    <input class="controls" type="text" id="apellido_pat" name="apellido_pat">

                    <label for="apellido_mat">Apellido Materno:</label>
                    <input class="controls" type="text" id="apellido_mat" name="apellido_mat">

                    <label for="telefono">Telefono</label>
                    <input class="controls" type="text" id="telefono" name="telefono">

                    <label for="celular">Celular</label>
                    <input class="controls" type="text" id="celular" name="celular">

                    <label for="email">Email</label>
                    <input class="controls" type="text" id="email" name="email">

                    <div class="btns">
                        <button id="get" class="buttons" type="button" onclick="obtenerAlumno()">Obtener</button>
                        <button id="update" class="buttons" type="button"
                            onclick="actualizarRegistro()">Actualizar</button>
                        <button id="create" class="buttons" type="button" onclick="crearAlumno()">Crear</button>
                        <button id="delete" class="buttons" type="button" onclick="eliminarRegistro()">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="datatable">
            <table id="alumnosTable" class="display">
                <thead>
                    <tr>
                        <th>CURP</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO PATERNO</th>
                        <th>APELLIDO MATERNO</th>
                        <th>TELEFONO</th>
                        <th>CELULAR</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($datos as $alumno) { ?>
                            <td>
                                <?php echo $alumno['CURP']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['NOMBRE']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['APELLIDO_PAT']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['APELLIDO_MAT']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['TELEFONO']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['CELULAR']; ?>
                            </td>
                            <td>
                                <?php echo $alumno['EMAIL']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function obtenerAlumno() {
            const curp = document.getElementById("curp").value;
            const nombre = document.getElementById("nombre");
            const apellido_pat = document.getElementById("apellido_pat");
            const apellido_mat = document.getElementById("apellido_mat");
            const telefono = document.getElementById("telefono");
            const celular = document.getElementById("celular");
            const email = document.getElementById("email");

            const response = await fetch(`http://localhost:3000/api/alumnos/"${curp}"`)
            const data = await response.json();

            data.forEach((alumno) => {
                nombre.value = `${alumno.NOMBRE}`;
                apellido_pat.value = `${alumno.APELLIDO_PAT}`;
                apellido_mat.value = `${alumno.APELLIDO_MAT}`;
                telefono.value = `${alumno.TELEFONO}`;
                celular.value = `${alumno.CELULAR}`;
                email.value = `${alumno.EMAIL}`;

            });
        }

        function crearAlumno() {
            const curp = document.getElementById("curp").value;
            const nombre = document.getElementById("nombre").value;
            const apellido_pat = document.getElementById("apellido_pat").value;
            const apellido_mat = document.getElementById("apellido_mat").value;
            const telefono = document.getElementById("telefono").value;
            const celular = document.getElementById("celular").value;
            const email = document.getElementById("email").value;

            const data = {
                CURP: curp,
                NOMBRE: nombre,
                APELLIDO_PAT: apellido_pat,
                APELLIDO_MAT: apellido_mat,
                TELEFONO: telefono,
                CELULAR: celular,
                EMAIL: email
            };

            fetch("http://localhost:3000/api/alumnos", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Agregado con Exito',
                    })
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser agregado',
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }

        function actualizarRegistro() {
            const nombre = document.getElementById("nombre").value;
            const apellido_pat = document.getElementById("apellido_pat").value;
            const apellido_mat = document.getElementById("apellido_mat").value;
            const telefono = document.getElementById("telefono").value;
            const celular = document.getElementById("celular").value;
            const email = document.getElementById("email").value;

            const curp = document.getElementById("curp").value;

            const data = {
                NOMBRE: nombre,
                APELLIDO_PAT: apellido_pat,
                APELLIDO_MAT: apellido_mat,
                TELEFONO: telefono,
                CELULAR: celular,
                EMAIL: email
            };

            fetch(`http://localhost:3000/api/alumnos/"${curp}"`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Actualizado con Exito',
                    })
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: 'El registro no pudo ser actualizado',
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }

        function eliminarRegistro() {
            const curp = prompt("Introduce el CURP del Alumno que deseas eliminar:");

            fetch(`http://localhost:3000/api/alumnos/"${curp}"`, {
                method: "DELETE"
            })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'CORRECTO',
                            text: 'Registro Eliminado con Exito',
                        })

                    } else if (response.status === 500) {
                        throw new Error('No se puede eliminar el registro porque tiene referencias')
                    } else {
                        throw new Error('El registro no pudo ser eliminado')
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: error.message,
                        footer: 'Mirar terminal para mas detalles'
                    })
                });
        }
    </script>
</body>

</html>