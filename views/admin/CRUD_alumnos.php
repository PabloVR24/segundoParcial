<?php
include(__DIR__ . '/../../includes/navbar.php')
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de películas</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../../css/styles-cruds.css">

<body>
    <div class="container">

        <div class="row">
            <div class="col">
                <form>

                    <div class="form-gs">

                        <h3>Alumnos</h3>
                        <label for="curp">CURP:</label>
                        <input class="controls" type="text" id="curp" name="curp"><br><br>

                        <label for="nombre">Nombre:</label>
                        <input class="controls" type="text" id="nombre" name="nombre"><br><br>

                        <label for="apellido_pat">Apellido Paterno:</label>
                        <input class="controls" type="text" id="apellido_pat" name="apellido_pat"><br><br>

                        <label for="apellido_mat">Apellido Materno:</label>
                        <input class="controls" type="text" id="apellido_mat" name="apellido_mat"><br><br>

                        <label for="telefono">Telefono</label>
                        <input class="controls" type="text" id="telefono" name="telefono"><br><br>

                        <label for="celular">Celular</label>
                        <input class="controls" type="text" id="celular" name="celular"><br><br>

                        <label for="email">Email</label>
                        <input class="controls" type="text" id="email" name="email"><br><br>

                        <div class="btns">
                            <button id="update" class="buttons" type="button" onclick="actualizarPelicula()">Actualizar</button>
                            <button id="create" class="buttons" type="button" onclick="crearAlumno()">Crear</button>
                            <button id="delete" class="buttons" type="button" onclick="eliminarPelicula()">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">

                <ul id="lista-alumnos"></ul>
            </div>
        </div>

    </div>

    <script>
        const listaAlumnos = document.getElementById('lista-alumnos');

        async function obtenerPeliculas() {
            const response = await fetch('http://localhost:3000/api/alumnos');
            const data = await response.json();

            listaAlumnos.innerHTML = '';
            data.forEach((alumno) => {
                const li = document.createElement('li');
                li.textContent = `${alumno.CURP} - ${alumno.NOMBRE} - (${alumno.APELLIDO_PAT}) - ${alumno.APELLIDO_MAT} - ${alumno.TELEFONO} - ${alumno.CELULAR} - ${alumno.EMAIL}`;
                listaAlumnos.appendChild(li);
            });
        }

        obtenerPeliculas()

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
                    obtenerPeliculas()
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

        function actualizarPelicula() {
            const nombre = document.getElementById("nombre").value;
            const apellido_pat = document.getElementById("apellido_pat").value;
            const apellido_mat = document.getElementById("apellido_mat").value;
            const telefono = document.getElementById("telefono").value;
            const celular = document.getElementById("celular").value;
            const email = document.getElementById("email").value;

            const curp = prompt("Introduce el CURP del alumno que deseas actualizar:");

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
                    obtenerPeliculas()
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

        function eliminarPelicula() {
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
                        obtenerPeliculas()
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