# Recursos
- El script de las tablas de MySQL se encuentra en el repositorio, solo es copiar y pegarlo en el workplace de MySQL (phpMyAdmin / MySQLWorkbench)

# Estructura de la base de datos  
![Estrcutura base de datos](/src/images/estructurabd.png)

# Estructura del proyecto 
No se rian ogts
![Estrcutura del proyecto](/src/images/MAL%20HECHO.png)

# COSAS QUE SE DEBEN HACER

- Login de Acceso (Usuario y Contraseña) con CAPTCHA **Raúl**

- El formulario de solicitud de ticket de turno (público) deberá tener la capacidad de registrar y/o modificar el registro en la parte pública por parte de los usuarios, para modificar solicite el CURP y el número de turno que se le asignó. En cada solicitud generé un comprobante de datos básicos con el turno correspondiente de la solicitud registrada, que sea en PDF con formato aceptable. El turno asignado deberá iniciar en 1 por cada municipio, cada municipio llevará su control interno de atención de 1 hasta n. **PABLO**

- Es muy importante que el comprobante pdf del usuario lleve un código QR, donde se identifique la CURP del alumno solicitante.**Raúl**

- Tener una opción de consulta por CURP o por nombre, para administradores y que puedan eliminar, modificar, registrar y colocar un estatus de “Resuelto” y “Pendiente”.

- Si hay catálogos en el modelo de datos, realizar el CRUD correspondiente y operable ara usuarios finales con Front End. **PABLO**

- Opción para cerrar sesión (Seguridad de la aplicación, parte privada) y Menú para navegar entre opciones. **PABLO**

- Deberá contener al menos la implementación del uso de estrategia de una API Rest, donde el equipo considere aplicarla.**Raúl**

- Tablero(dashboard) donde se muestre por medio de gráficas los estatus de las solicitudes (“Resuelto” y “Pendiente”) que pueda ser filtrado por municipio o por el total de solicitudes.

- Deberá utilizar un ORM para las operaciones sobre la base de datos.

- Deberá utilizar 1 patrón de diseño, recomendación el “singleton”.
