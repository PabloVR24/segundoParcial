<?php
include('class_alumno_dal.php');

// READ ONE (READ)
$obj_alumno = new catalogo_alumno_dal;
$resultado = $obj_alumno->datos_por_id("VARP151202HCLLNB05");
if ($resultado == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
}

// READ EVERYONE (READ)
$resultado2 = $obj_alumno->obtener_lista_alumno();
if ($resultado2 == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
}

/*
$obj_ins = new catalogo_alumno("VARP151202HCLLNB05", "PABLO", "VALERA", "RANGEL", "8444179155", "8443147167", "pavara_2010@hotmail.com");
$result_ins = $obj_alumno->inserta_alumno($obj_ins);
if ($result_ins == 1) {
    echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
}
*/

/*
$result_del = $obj_alumno->borrar_alumno("VARP151202HCLLNB05");
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}*/

// UPDATE
echo '<br>';

$obj_upd = new catalogo_alumno("VARP991202HCLLNB05", "PABLO2");
$result_upd = $obj_alumno->actualizar_alumno($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO ASUNTO</h2>";
}


//existe curso
echo '<br>';
$result_exis = $obj_alumno->existe_alumno("VARP991202HCLLNB05");
if ($result_exis == 1) {
    echo "<h2 style = 'color:green'>CURSO EXISTE</h2>";
} else {
    echo "<h2 style = 'color:red'>CURSO NO EXISTE</h2>";
}

?>