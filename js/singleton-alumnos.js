class AlumnosAPI {
    static instance;

    constructor() {
        if (AlumnosAPI.instance) {
            return AlumnosAPI.instance;
        }

        AlumnosAPI.instance = this;
    }

    async obtenerRegistro() {
        const curp = document.getElementById("curp").value;
        const nombre = document.getElementById("nombre");
        const apellido_pat = document.getElementById("apellido_pat");
        const apellido_mat = document.getElementById("apellido_mat");
        const telefono = document.getElementById("telefono");
        const celular = document.getElementById("celular");
        const email = document.getElementById("email");

        try {
            const response = await fetch(
                `http://localhost:3000/api/alumnos/"${curp}"`
            );
            if (response.ok) {
                const data = await response.json();
                if (data.length > 0) {
                    data.forEach((alumno) => {
                        nombre.value = `${alumno.NOMBRE}`;
                        apellido_pat.value = `${alumno.APELLIDO_PAT}`;
                        apellido_mat.value = `${alumno.APELLIDO_MAT}`;
                        telefono.value = `${alumno.TELEFONO}`;
                        celular.value = `${alumno.CELULAR}`;
                        email.value = `${alumno.EMAIL}`;
                    });
                } else {
                    throw new Error("Registro no encontrado");
                }
            } else {
                throw new Error("Error al buscar el registro");
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "ERROR",
                text: error.message,
            });
        }
    }

    async crearRegistro() {
        const curp = document.getElementById("curp").value;
        const nombre = document.getElementById("nombre").value;
        const apellido_pat = document.getElementById("apellido_pat").value;
        const apellido_mat = document.getElementById("apellido_mat").value;
        const telefono = document.getElementById("telefono").value;
        const celular = document.getElementById("celular").value;
        const email = document.getElementById("email").value;

        try {
            const response = await fetch(
                `http://localhost:3000/api/alumnos/"${curp}"`
            );
            if (response.ok) {
                const data = await response.json();
                if (data.length > 0) {
                    throw new Error("Registro existente");
                } else {
                    const data = {
                        CURP: curp,
                        NOMBRE: nombre,
                        APELLIDO_PAT: apellido_pat,
                        APELLIDO_MAT: apellido_mat,
                        TELEFONO: telefono,
                        CELULAR: celular,
                        EMAIL: email,
                    };

                    fetch("http://localhost:3000/api/alumnos", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(data),
                    }).then((response) => {
                        Swal.fire({
                            icon: "success",
                            title: "CORRECTO",
                            text: "Registro Agregado con Exito",
                        });
                    });
                }
            } else {
                throw new Error("Error al buscar el registro");
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "ERROR",
                text: error.message,
            });
        }
    }

    async actualizarRegistro() {
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
            EMAIL: email,
        };

        fetch(`http://localhost:3000/api/alumnos/"${curp}" `)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error al buscar el registro");
                }
                return response.json();
            })
            .then((json) => {
                if (json.length === 0) {
                    throw new Error("Registro no encontrado");
                }
                return fetch(`http://localhost:3000/api/alumnos/"${curp}"`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });
            })
            .then((response) => {
                if (response.ok) {
                    Swal.fire({
                        icon: "success",
                        title: "CORRECTO",
                        text: "Registro Actualizado con Exito",
                    });
                } else {
                    throw new Error("El registro no pudo ser actualizado");
                }
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "ERROR",
                    text: error.message,
                });
            });
    }

    async eliminarRegistro() {
        const curp = document.getElementById("curp").value;

        try {
            const response = await fetch(
                `http://localhost:3000/api/alumnos/"${curp}"`
            );
            if (response.ok) {
                const data = await response.json();
                if (data.length > 0) {
                    const eliminar = await fetch(
                        `http://localhost:3000/api/alumnos/"${curp}"`, {
                            method: "DELETE",
                        }
                    );
                    if (eliminar.ok) {
                        Swal.fire({
                            icon: "success",
                            title: "CORRECTO",
                            text: "Registro Eliminado con Exito",
                        });
                    } else {
                        throw new Error("El registro no pudo ser eliminado");
                    }
                } else if (response.status === 404) {
                    throw new Error("Registro no existente");
                } else {
                    throw new Error("El registro no pudo ser eliminado");
                }
            } else {
                throw new Error("Registro no encontrado");
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "ERROR",
                text: error.message,
            });
        }
    }
}
const alumnosAPI = new AlumnosAPI();