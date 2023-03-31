const express = require("express");
const cors = require("cors");
const { Sequelize, DataTypes } = require("sequelize");
const bodyParser = require("body-parser");

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

const Municipio = sequelize.define(
    "Municipio", {
        id_municipio: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true,
        },
        nombre_municipio: {
            type: DataTypes.STRING,
            allowNull: false,
        },
    }, {
        timestamps: false,
        tableName: "municipio",
    }
);

app.get("/api/municipios", async(req, res) => {
    try {
        const asuntos = await Municipio.findAll();
        res.send(asuntos);
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al obtener los municipios");
    }
});

app.get("/api/municipios/:id_asunto", async(req, res) => {
    const id = req.params.id_asunto;
    try {
        const asunto = await Municipio.findByPk(id);
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

app.post("/api/municipios", async(req, res) => {
    const nombre_municipio = req.body.nombre_municipio;
    try {
        const asunto = await Municipio.create({ nombre_municipio });
        res.send("Asunto agregado con éxito");
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al agregar el asunto");
    }
});

app.put("/api/municipios/:id_municipio", async(req, res) => {
    const id_municipio = req.params.id_municipio;
    const nombre_municipio = req.body.nombre_municipio;
    try {
        const [numRows, asuntos] = await Municipio.update({ nombre_municipio }, { where: { id_municipio } });
        if (numRows > 0) {
            res.send("Asunto actualizado con éxito");
        } else {
            res.status(404).send(`Asunto con id ${id_municipio} no encontrado`);
        }
    } catch (err) {
        console.log(err);
        res.status(500).send(`Error al actualizar el asunto con id ${id_asunto}`);
    }
});

app.delete("/api/municipios/:id", async(req, res) => {
    const id = req.params.id;
    try {
        await Municipio.destroy({ where: { id_municipio: id } });
        console.log(`Municipio eliminado con el id: ${id}`);
        res.status(200).send("Municipio eliminado correctamente");
    } catch (error) {
        console.log(error);
        res.status(500).send("Error al eliminar Municipio");
    }
});

const Nivel = sequelize.define(
    "Nivel", {
        id_nivel: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true,
        },
        nombre_nivel: {
            type: DataTypes.STRING,
            allowNull: false,
        },
    }, {
        timestamps: false,
        tableName: "niveles",
    }
);

app.get("/api/niveles", async(req, res) => {
    try {
        const asuntos = await Nivel.findAll();
        res.send(asuntos);
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al obtener los niveles");
    }
});

app.get("/api/niveles/:id_asunto", async(req, res) => {
    const id = req.params.id_asunto;
    try {
        const asunto = await Nivel.findByPk(id);
        if (asunto) {
            res.send(asunto);
        } else {
            res.status(404).send(`Nivel con id ${id} no encontrado`);
        }
    } catch (err) {
        console.log(err);
        res.status(500).send(`Error al obtener el Nivel con id ${id}`);
    }
});

app.post("/api/niveles", async(req, res) => {
    const nombre_nivel = req.body.nombre_nivel;
    try {
        const asunto = await Nivel.create({ nombre_nivel });
        res.send("Asunto agregado con éxito");
    } catch (err) {
        console.log(err);
        res.status(500).send("Error al agregar el asunto");
    }
});

app.put("/api/niveles/:id_nivel", async(req, res) => {
    const id_nivel = req.params.id_nivel;
    const nombre_nivel = req.body.nombre_nivel;
    try {
        const [numRows, asuntos] = await Nivel.update({ nombre_nivel }, { where: { id_nivel } });
        if (numRows > 0) {
            res.send("Nivel actualizado con éxito");
        } else {
            res.status(404).send(`Nivel con id ${id_nivel} no encontrado`);
        }
    } catch (err) {
        console.log(err);
        res.status(500).send(`Error al actualizar el Nivel con id ${id_nivel}`);
    }
});

app.delete("/api/niveles/:id", async(req, res) => {
    const id = req.params.id;
    try {
        await Nivel.destroy({ where: { id_nivel: id } });
        console.log(`Nivel eliminado con el id: ${id}`);
        res.status(200).send("Nivel eliminado correctamente");
    } catch (error) {
        console.log(error);
        res.status(500).send("Error al eliminar Nivel");
    }
});