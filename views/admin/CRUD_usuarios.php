<?php
include(__DIR__ . '/../../includes/navbar.php');
$url = "http://localhost:3000/api/usuarios";
$response = file_get_contents($url);
$datos = json_decode($response, true);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>CRUD - Usuarios</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../../css/styles-cruds.css">
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#usuariosTable').DataTable({
      responsive: true
    });
  });
</script>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <form>

          <div class="form-gs">

            <h3>Catalogo: Usuarios</h3>
            <label for="curp">CURP:</label>
            <input class="controls" type="text" id="curp" name="curp"><br><br>

            <label for="nombre">Nombre:</label>
            <input class="controls" type="text" id="nombre" name="nombre"><br><br>

            <label for="apellido_pat">Apellido Paterno:</label>
            <input class="controls" type="text" id="apellido_pat" name="apellido_pat"><br><br>

            <div class="btns">
              <button id="get" class="buttons" type="button" onclick="obtenerRegistro()">Obtener</button>
              <button id="update" class="buttons" type="button" onclick="actualizarRegistro()">Actualizar</button>
              <button id="create" class="buttons" type="button" onclick="crearRegistro()">Crear</button>
              <button id="delete" class="buttons" type="button" onclick="eliminarRegistro()">Eliminar</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-sm-8">
        <table id="usuariosTable" class="display">
          <thead>
            <tr>
              <th>NOMBRE_USUARIO</th>
              <th>NOMBRE</th>
              <th>CONTRASEÑA</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php foreach ($datos as $usuario) { ?>
                <td>
                  <?php echo $usuario['NOMBRE_USUARIO']; ?>
                </td>
                <td>
                  <?php echo $usuario['NOMBRE']; ?>
                </td>
                <td>
                  <?php echo $usuario['CONTRASEÑA']; ?>
                </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>

  <script>
    async function obtenerRegistro() {
      const nombre_usuario = document.getElementById("curp").value;
      const nombre = document.getElementById("nombre");
      const contraseña = document.getElementById("apellido_pat");

      try {
        const response = await fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}"`);
        if (response.ok) {
          const data = await response.json();
          if (data.length > 0) {
            data.forEach((usuario) => {
              nombre.value = `${usuario.NOMBRE}`;
              apellido_pat.value = `${usuario.APELLIDO_PAT}`;
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
      const nombre_usuario = document.getElementById("curp").value;
      const nombre = document.getElementById("nombre").value;
      const contraseña = document.getElementById("apellido_pat").value;

      try {
        const response = await fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}"`);
        if (response.ok) {
          const data = await response.json();
          if (data.length > 0) {
            throw new Error('Registro existente');
          } else {
            const data = {
              NOMBRE_USUARIO: nombre_usuario,
              NOMBRE: nombre,
              CONTRASEÑA: contraseña,
            };

            fetch("http://localhost:3000/api/usuarios", {
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
      const nombre = document.getElementById("nombre").value;
      const contraseña = document.getElementById("apellido_pat").value;
      const nombre_usuario = document.getElementById("curp").value;

      const data = {
        NOMBRE: nombre,
        CONTRASEÑA: contraseña
      };
      fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}" `)
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
          return fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}"`, {
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
      const nombre_usuario = document.getElementById("curp").value;

      try {
        const response = await fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}"`);
        if (response.ok) {
          const data = await response.json();
          if (data.length > 0) {
            const eliminar = await fetch(`http://localhost:3000/api/usuarios/"${nombre_usuario}"`, {
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