const express = require("express");
const usuarios = require("./routes/usuarios");
const app = express();
const port = process.env.PORT || 3030;
const cors = require("cors");
app.use(bodyParser.json());
app.use("/usuarios", usuarios);
app.use(cors);

app.listen(port, () => {
    console.log("Servidor ejecutandose en el puerto: ", port);
});

const { Sequelize, DataTypes } = require("sequelize");
const sequelize = new Sequelize("database", "username", "password", {
    dialect: "mysql",
    host: "localhost",
});

const Asunto = sequelize.define(
    "Asunto", {
        id_asunto: {
            type: DataTypes.INTEGER,
            allowNull: false,
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

module.exports = Asunto;