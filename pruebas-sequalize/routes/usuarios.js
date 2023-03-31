const express = require("express");
const cors = require("cors");
const { Sequelize, DataTypes } = require("sequelize");

const sequelize = new Sequelize("mydb", "root", "", {
    dialect: "mysql",
});

const Asunto = sequelize.define(
    "Asunto", {
        id_asunto: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true,
        },
        nombre_asunto: {
            type: DataTypes.STRING,
            allowNull: false,
        },
    }, {
        timestamps: false,
        tableName: "asunto",
    }
);

const app = express();
app.use(express.json());
app.use(cors());

const PORT = process.env.PORT || 4000;
app.listen(PORT, () => {
    console.log(`Servidor iniciado en el puerto ${PORT}`);
});

app.get("/api/asuntos", async(req, res) => {
    try {
        const asuntos = await Asunto.findAll();
        res.send(asuntos);
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al obtener los asuntos");
    }
});

app.get("/api/asuntos/:id_asunto", async(req, res) => {
    const id = req.params.id_asunto;
    try {
        const asunto = await Asunto.findByPk(id);
        if (asunto) {
            res.send(asunto);
        } else {
            res.status(404).send(`Asunto con id ${id} no encontrado`);
        }
    } catch (err) {
        console.log(err);
        res.status(500).send(`Error al obtener el asunto con id ${id}`);
    }
});

app.post("/api/asuntos", async(req, res) => {
    const nombre_asunto = req.body.nombre_asunto;
    try {
        const asunto = await Asunto.create({ nombre_asunto });
        res.send("Asunto agregado con éxito");
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al agregar el asunto");
    }
});

app.put("/api/asuntos/:id_asunto", async(req, res) => {
    const id_asunto = req.params.id_asunto;
    const nombre_asunto = req.body.nombre_asunto;
    try {
        const [numRows, asuntos] = await Asunto.update({ nombre_asunto }, { where: { id_asunto } });
        if (numRows > 0) {
            res.send("Asunto actualizado con éxito");
        } else {
            res.status(404).send(`Asunto con id ${id_asunto} no encontrado`);
        }
    } catch (err) {
        console.log(err);
        res.status(500).send(`Error al actualizar el asunto con id ${id_asunto}`);
    }
});

app.delete("/api/asuntos/:id", async(req, res) => {
    const id = req.params.id;
    try {

        await Asunto.destroy({ where: { id_asunto: id } });
        console.log(`Asunto eliminado con el id: ${id}`);
        res.status(200).send("Asunto eliminado correctamente");
    } catch (error) {
        console.log(error);
        res.status(500).send("Error al eliminar asunto");
    }
});