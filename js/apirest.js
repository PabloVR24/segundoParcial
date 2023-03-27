const express = require("express");
const mysql = require("mysql");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
app.use(bodyParser.json());
app.use(cors());

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor iniciado en el puerto ${PORT}`);
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






//TODO: TERMINAR@high
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
        db.query(`DELETE FROM usuarios WHERE NOMBRE_USUARIO = ${id}`, (err, result) => {
            if (err) {
                console.log(err);
                res.status(500).send("Error al eliminar alumno");
            } else {
                console.log(`Alumno eliminado con el CURP: ${id}`);
                res.status(200).send("Alumno eliminado correctamente");
            }
        });
    }

);