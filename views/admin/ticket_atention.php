<?php
include(__DIR__ . '/../../includes/navbar.php');
include('../../class/class_asunto/class_asunto_dal.php');
include('../../class/class_municipio/class_municipio_dal.php');
include('../../class/class_nivel/class_nivel_dal.php');
include('../../class/class_alumno/class_alumno_dal.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Atencion a Ticket</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../../css/styles-cruds.css">
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
<script>

</script>

<body>
    <div class="container">
        <div class="CRUD">
            <form>
                <div class="form-gs">
                    <h1>Catalogo: Ticket</h1>

                    <?php
                    $obj_lista_alumnos = new catalogo_alumno_dal;
                    $result_alumnos = $obj_lista_alumnos->obtener_lista_alumno();

                    if ($result_alumnos == null) {
                        echo '<h2> No se encontraron Municipios </h2>';
                    } else {
                    ?><label for="mes2">Alumno:
                        </label>
                        <select class="form-control" name="curp" id="curp" value="<?php echo isset($_POST["curp"]) ? $_POST["curp"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_alumnos as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->getCURP() ?>"><?= $value->getNOMBRE() . " " . $value->getAPELLIDO_PAT(). " " . " " . $value->getAPELLIDO_MAT(). " - " . $value->getCURP() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>

                    <br>
                    <?php if (!empty($error_mes2)) { ?>
                        <span class="error"><?php echo $error_mes2; ?></span>
                    <?php } ?>

                    <label for="id_ticket">ID_TICKET:</label>
                    <input class="form-control" type="text" id="id_ticket" name="id_ticket">

                    <label for="nombre">Nombre:</label>
                    <input class="form-control" class="form-control" type="text" id="nombre" name="nombre">

                    <label for="fecha">Fecha:</label>
                    <input class="form-control" type="text" id="fecha" name="fecha">

                    <?php
                    $obj_lista_asuntos = new catalogo_asunto_dal;
                    $result_asuntos = $obj_lista_asuntos->obtener_lista_ASUNTO();

                    if ($result_asuntos == null) {
                        echo '<h2> No se encontraron Asuntos </h2>';
                    } else {
                    ?><label for="mes1">Asunto a tratar:
                        </label>
                        <select name="mes1" class="form-control" id="mes1" value="<?php echo isset($_POST["mes1"]) ? $_POST["mes1"] : ""; ?>">
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
                    <br>
                    <?php if (!empty($error_mes1)) { ?>
                        <span class="error"><?php echo $error_mes1; ?></span>
                    <?php } ?>
                    <?php
                    $obj_lista_niveles = new catalogo_nivel_dal;
                    $result_nivel = $obj_lista_niveles->obtener_lista_niveles();
                    if ($result_nivel == null) {
                        echo '<h2> No se encontraron Niveles </h2>';
                    } else {
                    ?><label for="mes">Nivel al que desea ingresar o que ya cursa el alumno:
                        </label>
                        <select name="mes" class="form-control" id="mes" value="<?php echo isset($_POST["mes"]) ? $_POST["mes"] : ""; ?>">
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

                    <br>
                    <?php if (!empty($error_mes)) { ?>
                        <span class="error"><?php echo $error_mes; ?></span>
                    <?php } ?>

                    <?php
                    $obj_lista_municipio = new catalogo_municipio_dal;
                    $result_municipio = $obj_lista_municipio->obtener_lista_municipio();

                    if ($result_municipio == null) {
                        echo '<h2> No se encontraron Municipios </h2>';
                    } else {
                    ?><label for="mes2">Municipio:
                        </label>
                        <select class="form-control" name="mes2" id="mes2" value="<?php echo isset($_POST["mes2"]) ? $_POST["mes2"] : ""; ?>">
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

                    <br>
                    <?php if (!empty($error_mes2)) { ?>
                        <span class="error"><?php echo $error_mes2; ?></span>
                    <?php } ?>

                    <label for="estatus">ESTATUS:</label>
                    <select class="form-control" name="estaus" id="estatus">
                        <option hidden value=""></option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="RESUELTO">RESUELTO</option>
                    </select>
                    <div class="btns">
                        <button id="get" class="buttons" type="button" onclick="obtenerRegistroCurp()">Obtener</button>
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
                        <th>ID_TICKET</th>
                        <th>NOMBRE</th>
                        <th>FECHA</th>
                        <th>ID_ASUNTO</th>
                        <th>ID_NIVEL</th>
                        <th>ID_MUNICIPIO</th>
                        <th>ESTATUS</th>
                    </tr>
                </thead>
                <tbody id="tablaRegistros">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#alumnosTable').DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        async function obtenerRegistroCurp() {
            const id_ticket = document.getElementById("id_ticket");
            const nombre_usuario = document.getElementById("nombre");
            const curp = document.getElementById("curp").value;
            const fecha = document.getElementById("fecha");
            const asunto = document.getElementById("mes1");
            const nivel = document.getElementById("mes");
            const municipio = document.getElementById("mes2");
            const estatus = document.getElementById("estatus");

            var table = $('#alumnosTable').DataTable();
            table.clear().draw();

            try {
                const response = await fetch(`http://localhost:3000/api/tickets/curp/"${curp}"`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        data.forEach(ticket => {
                            var rowData = [
                                ticket.ID_TICKET,
                                ticket.NOMBRE_USUARIO,
                                ticket.FECHA,
                                ticket.ID_ASUNTO,
                                ticket.ID_NIVEL,
                                ticket.ID_MUNICIPIO,
                                ticket.ESTATUS
                            ];

                            table.row.add(rowData).draw().nodes().to$().on('click', function() {
                                obtenerRegistro(ticket.ID_TICKET);
                            });
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


        async function obtenerRegistro(id_ticket) {
            const input_id_ticket = document.getElementById("id_ticket");
            const nombre_usuario = document.getElementById("nombre");
            const curp = document.getElementById("curp");
            const fecha = document.getElementById("fecha");
            const asunto = document.getElementById("mes1");
            const nivel = document.getElementById("mes");
            const municipio = document.getElementById("mes2");
            const estatus = document.getElementById("estatus");

            try {
                const response = await fetch(`http://localhost:3000/api/tickets/"${id_ticket}"`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        data.forEach((alumno) => {
                            input_id_ticket.value = `${alumno.ID_TICKET}`;
                            nombre_usuario.value = `${alumno.NOMBRE_USUARIO}`;
                            curp.value = `${alumno.CURP}`
                            fecha.value = `${alumno.FECHA}`
                            asunto.value = `${alumno.ID_ASUNTO}`;
                            nivel.value = `${alumno.ID_NIVEL}`;
                            municipio.value = `${alumno.ID_MUNICIPIO}`;
                            estatus.value = `${alumno.ESTATUS}`;;
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

        function actualizarRegistro() {
            const id_ticket = document.getElementById("id_ticket").value;
            const nombre_usuario = document.getElementById("nombre").value;
            const curp = document.getElementById("curp").value;
            const fecha = document.getElementById("fecha").value;
            const id_asunto = document.getElementById("mes1").value;
            const id_nivel = document.getElementById("mes").value;
            const id_municipio = document.getElementById("mes2").value;
            const estatus = document.getElementById("estatus").value;

            const data = {
                NOMBRE_USUARIO: nombre_usuario,
                CURP: curp,
                FECHA: fecha,
                ID_ASUNTO: id_asunto,
                ID_NIVEL: id_nivel,
                ID_MUNICIPIO: id_municipio,
                ESTATUS: estatus
            };

            fetch(`http://localhost:3000/api/tickets/"${id_ticket}" `)
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
                    return fetch(`http://localhost:3000/api/tickets/"${id_ticket}"`, {
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
            const id_ticket = document.getElementById("id_ticket").value;

            try {
                const response = await fetch(`http://localhost:3000/api/tickets/"${id_ticket}"`);
                if (response.ok) {
                    const data = await response.json();
                    if (data.length > 0) {
                        const eliminar = await fetch(`http://localhost:3000/api/tickets/"${id_ticket}"`, {
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