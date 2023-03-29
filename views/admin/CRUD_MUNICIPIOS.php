<?php
include(__DIR__ . '/../../includes/navbar.php');
$url = "http://localhost:3000/api/municipios";
$response = file_get_contents($url);
$datos = json_decode($response, true);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD - MUNICIPIOS</title>
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
                    <h3>Catalogo: Municipios</h3>
                    <label for="curp">ID_MUNICIPIO:</label>
                    <input class="controls" type="text" id="curp" name="curp">

                    <label for="nombre">NOMBRE_MUNICIPIO:</label>
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
                        <th>ID_MUNICIPIO</th>
                        <th>NOMBRE_MUNICIPIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($datos as $municipio) { ?>
                            <td>
                                <?php echo $municipio['ID_MUNICIPIO']; ?>
                            </td>
                            <td>
                                <?php echo $municipio['NOMBRE_MUNICIPIO']; ?>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function obtenerRegistro() {
            const id_municipio = document.getElementById("curp").value;
            const nombre_municipio = document.getElementById("nombre");

            try {
                const response = await fetch(`http://localhost:3000/api/municipios/"${id_municipio}"`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        data.forEach((municipio) => {
                            nombre_municipio.value = `${municipio.NOMBRE_MUNICIPIO}`;
                        });
                    } else {
                        throw new Error('Registro no encontrado');
                    }
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
            const id_municipio = document.getElementById("curp").value;
            const nombre_municipio = document.getElementById("nombre").value;

            try {
                const response = await fetch(`http://localhost:3000/api/municipios/"${id_municipio}"`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        throw new Error('Registro existente');
                    } else {
                        const data = {
                            NOMBRE_MUNICIPIO: nombre_municipio,
                        };

                        fetch("http://localhost:3000/api/municipios", {
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
                    }
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

        function actualizarRegistro() {
            const nombre_municipio = document.getElementById("nombre").value;
            const id_municipio = document.getElementById("curp").value;

            const data = {
                NOMBRE_MUNICIPIO: nombre_municipio,
            };

            fetch(`http://localhost:3000/api/municipios/"${id_municipio}" `)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al buscar el registro');
                    }
                    return response.json();
                })
                .then(json => {
                    if (json.length === 0) {
                        throw new Error('Registro no encontrado');
                    }
                    return fetch(`http://localhost:3000/api/municipios/"${id_municipio}"`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    });
                })
                .then(response => {
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
            const id_municipio = parseInt(document.getElementById("curp").value);

            try {
                const response = await fetch(`http://localhost:3000/api/municipios/${id_municipio}`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        const eliminar = await fetch(`http://localhost:3000/api/municipios/${id_municipio}`, {
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
                    } else if (response.status === 404) {
                        throw new Error('Registro no existente')
                    } else {
                        throw new Error('El registro no pudo ser eliminado')
                    }
                } else {
                    throw new Error('Registro no encontrado');
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