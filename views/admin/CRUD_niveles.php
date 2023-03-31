<?php
include(__DIR__ . '/../../includes/navbar.php');
$url = "http://localhost:4000/api/niveles";
$response = file_get_contents($url);
$datos = json_decode($response, true);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD - Niveles</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../../css/styles-cruds.css">
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
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
                    <h3>Catalogo: Niveles</h3>
                    <label for="curp">ID_NIVEL:</label>
                    <input class="controls" type="text" id="curp" name="curp">

                    <label for="nombre">NOMBRE_NIVEL:</label>
                    <input class="controls" type="text" id="nombre" name="nombre">

                    <div class="btns">
                        <button id="get" class="buttons" type="button" onclick="obtenerRegistro()">Obtener</button>
                        <button id="update" class="buttons" type="button" onclick="actualizarRegistro()">Actualizar</button>
                        <button id="create" class="buttons" type="button" onclick="crearRegistro()">Crear</button>
                        <button id="delete" class="buttons" type="button" onclick="eliminarRegistro()">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="datatable">
            <table id="alumnosTable" class="display">
                <thead>
                    <tr>
                        <th>ID_NIVEL</th>
                        <th>NOMBRE_NIVEL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($datos as $nivel) { ?>
                            <td>
                                <?php echo $nivel['id_nivel']; ?>
                            </td>
                            <td>
                                <?php echo $nivel['nombre_nivel']; ?>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function obtenerRegistro() {
            const id_asunto = document.getElementById("curp").value;
            const nombre_asunto = document.getElementById("nombre");
            try {
                const response = await fetch(`http://localhost:4000/api/niveles/${id_asunto}`);
                if (response.ok) {
                    const data = await response.json();
                    nombre.value = `${data.nombre_nivel}`;
                } else {
                    throw new Error('Error al buscar el registro');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: error.message,
                });
            }
        }

        async function crearRegistro() {
            const id_asunto = document.getElementById("curp").value;
            const nombre_asunto = document.getElementById("nombre").value;
            try {
                const data = {
                    nombre_nivel: nombre_asunto,
                };

                fetch("http://localhost:4000/api/niveles", {
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
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: error.message,
                });
            }

        }

        function actualizarRegistro() {
            const nombre_asunto = document.getElementById("nombre").value;
            const id_asunto = document.getElementById("curp").value;

            const data = {
                nombre_nivel: nombre_asunto,
            };

            fetch(`http://localhost:4000/api/niveles/${id_asunto}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                }).then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'CORRECTO',
                            text: 'Registro Actualizado con Exito',
                        })
                    } else {
                        throw new Error('El registro no pudo ser actualizado')
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: error.message
                    })
                });
        }

        async function eliminarRegistro() {
            const id_asunto = document.getElementById("curp").value;
            try {
                const eliminar = await fetch(`http://localhost:4000/api/niveles/${id_asunto}`, {
                    method: 'DELETE'
                });

                if (eliminar.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO',
                        text: 'Registro Eliminado con Exito',
                    })
                } else {
                    throw new Error('El registro no pudo ser eliminado')
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: error.message,
                });
            }
        }
    </script>
</body>

</html>