<?php
include('class_municipio_dal.php');

// READ ONE (READ)
$obj_municipio = new catalogo_municipio_dal;
$resultado = $obj_municipio->datos_por_id(1);
if ($resultado == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
}

// READ EVERYONE (READ)
$resultado2 = $obj_municipio->obtener_lista_municipio();
if ($resultado2 == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
}


$obj_ins = new catalogo_municipio(null, "TERCERO");
$result_ins = $obj_municipio->inserta_municipio($obj_ins);
if ($result_ins == 1) {
    echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
}


$result_del = $obj_municipio->borrar_municipio(4);
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}

// UPDATE
$obj_upd = new catalogo_municipio("2", "PRUEBA2");
$result_upd = $obj_municipio->actualizar_municipio($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO ASUNTO</h2>";

}
?>