const express = require("express");
const app = express();
const bodyParser = require("body-parser");
const { Sequelize, DataTypes } = require("sequelize");
const sequelize = new Sequelize("mydb", "root", "", {
    dialect: "mysql",
    host: "localhost",
});
const PORT = 4000; // puerto que deseas usar
// Definir rutas y configuraciones adicionales aquí
// Iniciar servidor
app.listen(PORT, () => {
    console.log(`Servidor iniciado en el puerto ${PORT}`);
});
// Definición del modelo de Asunto
const Asunto = sequelize.define(
    "Asunto", {
        id_asunto: {
            type: DataTypes.INTEGER,
            allowNull: false,
            autoIncrement: true,
            primaryKey: true,
        },
        nombre_asunto: {
            type: DataTypes.STRING,
            allowNull: false,
        },
    }, {
        tableName: "asunto",
    }
);

// Middleware para parsear los datos en el cuerpo de la solicitud
app.use(bodyParser.json());

// Obtener todos los asuntos
app.get("/api/asuntos", (req, res) => {
    Asunto.findAll({
            attributes: ["id_asunto", "nombre_asunto"],
        })
        .then((asuntos) => {
            res.send(asuntos);
        })
        .catch((err) => {
            console.log(err);
            res.status(500).send("Error al obtener los asuntos");
        });
});

// Obtener un asunto por su ID
app.get("/api/asuntos/:id_asunto", (req, res) => {
    const id = req.params.id_asunto;
    Asunto.findByPk(id, { attributes: ["id_asunto", "nombre_asunto"] })
        .then((asunto) => {
            if (!asunto) {
                res.status(404).send("Asunto no encontrado");
            } else {
                res.send(asunto);
            }
        })
        .catch((err) => {
            console.log(err);
            res.status(500).send("Error al obtener el asunto");
        });
});

// Crear un nuevo asunto
app.post("/api/asuntos", (req, res) => {
    const nombre_asunto = req.body.nombre_asunto;
    Asunto.create({
            nombre_asunto: nombre_asunto,
        })
        .then(() => {
            res.send("Asunto agregado con éxito");
        })
        .catch((err) => {
            console.log(err);
            res.status(500).send("Error al agregar el asunto");
        });
});

// Actualizar un asunto existente
app.put("/api/asuntos/:id_asunto", (req, res) => {
    const id_asunto = req.params.id_asunto;
    const nombre_asunto = req.body.nombre_asunto;
    Asunto.update({
            nombre_asunto: nombre_asunto,
        }, {
            where: {
                id_asunto: id_asunto,
            },
        })
        .then((rowsUpdated) => {
            if (rowsUpdated[0] === 0) {
                res.status(404).send("Asunto no encontrado");
            } else {
                res.send("Asunto actualizado con éxito");
            }
        })
        .catch((err) => {
            console.log(err);
            res.status(500).send("Error al actualizar el asunto");
        });
});

// Eliminar un asunto por su ID
app.delete("/api/asuntos/:id_asunto", (req, res) => {
    const id = req.params.id_asunto;
    sequelize.transaction((t) => {
        return Asunto.count({
            where: {
                id_asunto: id,
            },
            transaction: t,
        }).then((count) => {
            if (count > 0) {
                throw new Error(
                    "No se puede eliminar el asunto porque tiene referencias en la tabla ticket"
                );
            } else {
                return Asunto.destroy({
                    where: {
                        id_asunto: id,
                    },
                    transaction: t,
                });
            }
        });
    });
});