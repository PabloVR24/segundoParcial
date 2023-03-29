const formulario = document.getElementById("forms");
const btnSubmit = document.getElementById("btnSubmit");
let varia = "";
let variable;

formulario.addEventListener("submit", (e) => {
    let messages = [];

    let expName = /^[a-zA-Z ]{3,30}?$/;
    let patFname = document.getElementById("fname").value.trim();

    if (patFname == "") {
        messages.push("FALTANTE: Nombre");
    } else if (!expName.test(patFname)) {
        messages.push("INVALIDO: Nombre ");
    }

    let patCURP = document.getElementById("lCurp").value.trim();
    let expCURP = /^[a-zA-Z]{4}(\d{6})([a-zA-Z]{6})(([a-zA-Z0-9]){2})?$/;

    if (!expCURP.test(patCURP)) {
        messages.push("CURP");
    } else {
        let year = patCURP[4] + patCURP[5];
        let mth = patCURP[6] + patCURP[7];
        let day = patCURP[8] + patCURP[9];

        edad = getDate(day, mth, year);
        let gradoEscolar = "";
        if (edad >= 3 && edad < 6) {
            gradoEscolar = "Preescolar";
        } else if (edad >= 6 && edad < 12) {
            gradoEscolar = "Primaria";
        } else if (edad >= 12 && edad < 15) {
            gradoEscolar = "Secundaria";
        } else {
            Swal.fire({
                icon: "error",
                title: "Cita no agendada",
                text: "La cita no se podra agendar en linea",
                footer: "Acudir personalmente",
            });
            e.preventDefault();
        }
        console.log(gradoEscolar);
    }

    function getDate(day, mth, year) {
        let today = new Date();
        if (year > 30) {
            yr = 19;
        } else {
            yr = 20;
        }
        let cumple = new Date(yr + "" + year + "-" + mth + "-" + day);
        let age = today.getFullYear() - cumple.getFullYear();

        if (
            today.getMonth() < cumple.getMonth() ||
            (today.getMonth() == cumple.getMonth() &&
                today.getDate() < cumple.getDate())
        ) {
            age--;
        }
        return age;
    }
    let patNivel = document.getElementById("mes").value.trim();

    if (patNivel.length == 0) {
        messages.push("FALTANTE: Nivel");
    }

    let patAsunto = document.getElementById("mes1").value.trim();

    if (patAsunto.length == 0) {
        messages.push("FALTANTE: Asunto");
    }

    let patMunicipio = document.getElementById("mes2").value.trim();
    if (patMunicipio.length == 0) {
        messages.push("FALTANTE: Municipio");
    }

    let patFecha = document.getElementById("fecha").value.trim();
    if (patFecha.length == 0) {
        messages.push("FALTANTE: Fecha");
    }

    if (messages.length > 0) {
        Swal.fire({
            icon: "info",
            title: "Error en campos",
            text: messages.join(" --- "),
            footer: "Complete o verifique los campos mencionados",
        });
        e.preventDefault();
    }
});