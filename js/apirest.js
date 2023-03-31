const express = require("express");
const mysql = require("mysql");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
app.use(bodyParser.json());
app.use(cors());

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor iniciado en el puerto 4000`);
});

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "mydb",
});

db.connect((err) => {
    if (err) {
        console.log(err);
        throw err;
    }
    console.log("Conectado a la base de datos MySQL");
});

app.get("/api/alumnos", (req, res) => {
    db.query("SELECT * FROM alumno", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/alumnos/:id", (req, res) => {
    const id = req.params.id;
    db.query(`SELECT * FROM alumno WHERE CURP = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.post("/api/alumnos", (req, res) => {
    const CURP = req.body.CURP;
    const nombre = req.body.NOMBRE;
    const apellido_pat = req.body.APELLIDO_PAT;
    const apellido_mat = req.body.APELLIDO_MAT;
    const telefono = req.body.TELEFONO;
    const celular = req.body.CELULAR;
    const email = req.body.EMAIL;

    db.query(
        `INSERT INTO ALUMNO (CURP, nombre, apellido_pat, apellido_mat, telefono, celular, email) VALUES ('${CURP}', '${nombre}', '${apellido_pat}', '${apellido_mat}', '${telefono}', '${celular}', '${email}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Alumno agregado con éxito");
        }
    );
});

app.put("/api/alumnos/:CURP", (req, res) => {
    const CURP = req.params.CURP;
    const nombre = req.body.NOMBRE;
    const apellido_pat = req.body.APELLIDO_PAT;
    const apellido_mat = req.body.APELLIDO_MAT;
    const telefono = req.body.TELEFONO;
    const celular = req.body.CELULAR;
    const email = req.body.EMAIL;

    db.query(
        `UPDATE alumno SET nombre = '${nombre}', apellido_pat = '${apellido_pat}', apellido_mat = '${apellido_mat}', telefono = '${telefono}', celular = '${celular}', email = '${email}' WHERE CURP = ${CURP}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Alumno actualizado con éxito");
        }
    );
});

app.delete("/api/alumnos/:id", (req, res) => {
    const id = req.params.id;

    db.query(
        `SELECT COUNT(*) AS count FROM ticket WHERE CURP = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al verificar referencias");
            } else {
                const count = result[0].count;
                if (count > 0) {
                    res
                        .status(500)
                        .send(
                            "No se puede eliminar el alumno porque tiene referencias en la tabla ticket"
                        );
                } else {
                    db.query(`DELETE FROM alumno WHERE CURP = ${id}`, (err, result) => {
                        if (err) {
                            console.log(err);
                            res.status(500).send("Error al eliminar alumno");
                        } else {
                            console.log(`Alumno eliminado con el CURP: ${id}`);
                            res.status(200).send("Alumno eliminado correctamente");
                        }
                    });
                }
            }
        }
    );
});

// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:

app.get("/api/usuarios", (req, res) => {
    db.query("SELECT * FROM usuarios", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/usuarios/:NOMBRE_USUARIO", (req, res) => {
    const id = req.params.NOMBRE_USUARIO;
    db.query(
        `SELECT * FROM usuarios WHERE NOMBRE_USUARIO = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send(result);
        }
    );
});

app.post("/api/usuarios", (req, res) => {
    const nombre_usuario = req.body.NOMBRE_USUARIO;
    const nombre = req.body.NOMBRE;
    const contreseña = req.body.CONTRASEÑA;

    db.query(
        `INSERT INTO USUARIOS (NOMBRE_USUARIO, NOMBRE, CONTRASEÑA) VALUES ('${nombre_usuario}', '${nombre}', '${contreseña}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Usuario agregado con éxito");
        }
    );
});

app.put("/api/usuarios/:nombre_usuario", (req, res) => {
    const nombre_usuario = req.params.nombre_usuario;
    const nombre = req.body.NOMBRE;
    const contreseña = req.body.CONTRASEÑA;

    db.query(
        `UPDATE USUARIOS SET nombre = '${nombre}', contraseña = '${contreseña}' WHERE NOMBRE_USUARIO = ${nombre_usuario}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Usuario actualizado con éxito");
        }
    );
});


app.delete("/api/usuarios/:NOMBRE_USUARIO", (req, res) => {
    const id = req.params.NOMBRE_USUARIO;
    db.query(
        `DELETE FROM usuarios WHERE NOMBRE_USUARIO = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al eliminar alumno");
            } else {
                console.log(`Alumno eliminado con el CURP: ${id}`);
                res.status(200).send("Alumno eliminado correctamente");
            }
        }
    );
});

// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:

app.get("/api/municipios", (req, res) => {
    db.query("SELECT * FROM municipio", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/municipios/:id_municipio", (req, res) => {
    const id = req.params.id_municipio;
    db.query(
        `SELECT * FROM municipio WHERE id_municipio = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send(result);
        }
    );
});

app.post("/api/municipios", (req, res) => {
    const nombre_municipio = req.body.NOMBRE_MUNICIPIO;

    db.query(
        `INSERT INTO MUNICIPIO (ID_MUNICIPIO, NOMBRE_MUNICIPIO) VALUES (NULL, '${nombre_municipio}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Municipio agregado con éxito");
        }
    );
});

app.put("/api/municipios/:id_municipio", (req, res) => {
    const id_municipio = req.params.id_municipio;
    const nombre_municipio = req.body.NOMBRE_MUNICIPIO;

    db.query(
        `UPDATE MUNICIPIO SET nombre_municipio = '${nombre_municipio}' WHERE id_municipio = ${id_municipio}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Municipio actualizado con éxito");
        }
    );
});

app.delete("/api/municipios/:id", (req, res) => {
    const id = req.params.id;
    db.query(
        `SELECT COUNT(*) AS count FROM ticket WHERE ID_MUNICIPIO = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al verificar referencias");
            } else {
                const count = result[0].count;
                if (count > 0) {
                    res
                        .status(500)
                        .send(
                            "No se puede eliminar el municipio porque tiene referencias en la tabla ticket"
                        );
                } else {
                    db.query(
                        `DELETE FROM municipio WHERE id_municipio = ${id}`,
                        (err, result) => {
                            if (err) {
                                console.log(err);
                                res.status(500).send("Error al eliminar alumno");
                            } else {
                                console.log(`Municipio eliminado con el id: ${id}`);
                                res.status(200).send("Municipio eliminado correctamente");
                            }
                        }
                    );
                }
            }
        }
    );
});

// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:

app.get("/api/asuntos", (req, res) => {
    db.query("SELECT * FROM asunto", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/asuntos/:id_asunto", (req, res) => {
    const id = req.params.id_asunto;
    db.query(`SELECT * FROM asunto WHERE id_asunto = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.post("/api/asuntos", (req, res) => {
    const nombre_asunto = req.body.NOMBRE_ASUNTO;

    db.query(
        `INSERT INTO asunto (id_asunto, NOMBRE_ASUNTO) VALUES (NULL, '${nombre_asunto}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Asunto agregado con éxito");
        }
    );
});

app.put("/api/asuntos/:id_asunto", (req, res) => {
    const id_asunto = req.params.id_asunto;
    const nombre_asunto = req.body.NOMBRE_ASUNTO;

    db.query(
        `UPDATE asunto SET nombre_asunto = '${nombre_asunto}' WHERE id_asunto = ${id_asunto}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Asunto actualizado con éxito");
        }
    );
});

app.delete("/api/asuntos/:id", (req, res) => {
    const id = req.params.id;
    db.query(
        `SELECT COUNT(*) AS count FROM ticket WHERE id_asunto = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al verificar referencias");
            } else {
                const count = result[0].count;
                if (count > 0) {
                    res
                        .status(500)
                        .send(
                            "No se puede eliminar el asunto porque tiene referencias en la tabla ticket"
                        );
                } else {
                    db.query(
                        `DELETE FROM asunto WHERE id_asunto = ${id}`,
                        (err, result) => {
                            if (err) {
                                console.log(err);
                                res.status(500).send("Error al eliminar alumno");
                            } else {
                                console.log(`Municipio eliminado con el id: ${id}`);
                                res.status(200).send("Municipio eliminado correctamente");
                            }
                        }
                    );
                }
            }
        }
    );
});

// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:

app.get("/api/niveles", (req, res) => {
    db.query("SELECT * FROM niveles", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/niveles/:id_nivel", (req, res) => {
    const id = req.params.id_nivel;
    db.query(`SELECT * FROM niveles WHERE id_nivel = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.post("/api/niveles", (req, res) => {
    const nombre_nivel = req.body.NOMBRE_NIVEL;

    db.query(
        `INSERT INTO niveles (id_nivel, NOMBRE_NIVEL) VALUES (NULL, '${nombre_nivel}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Nivel agregado con éxito");
        }
    );
});

app.put("/api/niveles/:id_nivel", (req, res) => {
    const id_nivel = req.params.id_nivel;
    const nombre_nivel = req.body.NOMBRE_NIVEL;
    db.query(
        `UPDATE niveles SET nombre_nivel = '${nombre_nivel}' WHERE id_nivel = ${id_nivel}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Nivel actualizado con éxito");
        }
    );
});

app.delete("/api/niveles/:id", (req, res) => {
    const id = req.params.id;
    db.query(
        `SELECT COUNT(*) AS count FROM ticket WHERE id_nivel = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al verificar referencias");
            } else {
                const count = result[0].count;
                if (count > 0) {
                    res
                        .status(500)
                        .send(
                            "No se puede eliminar el nivel porque tiene referencias en la tabla ticket"
                        );
                } else {
                    db.query(
                        `DELETE FROM niveles WHERE id_nivel = ${id}`,
                        (err, result) => {
                            if (err) {
                                console.log(err);
                                res.status(500).send("Error al eliminar alumno");
                            } else {
                                console.log(`Municipio eliminado con el id: ${id}`);
                                res.status(200).send("Municipio eliminado correctamente");
                            }
                        }
                    );
                }
            }
        }
    );
});

// TODO:
// TODO:
// TODO:
// TODO:
// TODO:
// TODO:

app.get("/api/tickets", (req, res) => {
    db.query("SELECT * FROM ticket", (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.get("/api/tickets/:id_ticket", (req, res) => {
    const id = req.params.id_ticket;
    db.query(`SELECT * FROM ticket WHERE id_ticket = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});

app.post("/api/tickets", (req, res) => {
    const id_ticket = req.body.ID_TICKET;
    const nombre_usuario = req.body.NOMBRE_USUARIO;
    const curp = req.body.CURP;
    const fecha = req.body.FECHA;
    const id_asunto = req.body.ID_ASUNTO;
    const id_nivel = req.body.ID_NIVEL;
    const id_municipio = req.body.ID_MUNICIPIO;
    const estatus = req.body.ESTATUS;

    db.query(
        `INSERT INTO ticket (ID_TICKET, NOMBRE_USUARIO, CURP, FECHA, ID_ASUNTO, ID_NIVEL, ID_MUNICIPIO, ESTATUS) VALUES ('${id_ticket}', '${nombre_usuario}' , '${curp}', '${fecha}', '${id_asunto}', '${id_nivel}', '${id_municipio}' , '${estatus}')`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Ticket agregado con éxito");
        }
    );
});

app.put("/api/tickets/:id_ticket", (req, res) => {
    const id_ticket = req.params.id_ticket;
    const nombre_usuario = req.body.NOMBRE_USUARIO;
    const curp = req.body.CURP;
    const fecha = req.body.FECHA;
    const id_asunto = req.body.ID_ASUNTO;
    const id_nivel = req.body.ID_NIVEL;
    const id_municipio = req.body.ID_MUNICIPIO;
    const estatus = req.body.ESTATUS;

    db.query(
        `UPDATE ticket SET nombre_usuario = '${nombre_usuario}', curp = '${curp}', fecha = '${fecha}', id_asunto = '${id_asunto}', id_nivel = '${id_nivel}', id_municipio = '${id_municipio}', estatus = '${estatus}' WHERE id_ticket = ${id_ticket}`,
        (err, result) => {
            if (err) {
                console.log(err);
                throw err;
            }
            res.send("Ticket actualizado con éxito");
        }
    );
});


app.delete("/api/tickets/:id_ticket", (req, res) => {
    const id = req.params.id_ticket;
    db.query(
        `DELETE FROM ticket WHERE id_ticket = ${id}`,
        (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al eliminar ticket");
            } else {
                console.log(`Ticket eliminado con el CURP: ${id}`);
                res.status(200).send("Ticket eliminado correctamente");
            }
        }
    );
});

//TODO:
//TODO:
//TODO:
//TODO:
//TODO:


app.get("/api/tickets/curp/:curp", (req, res) => {
    const id = req.params.curp;
    db.query(`SELECT * FROM ticket WHERE CURP = ${id}`, (err, result) => {
        if (err) {
            console.log(err);
            throw err;
        }
        res.send(result);
    });
});