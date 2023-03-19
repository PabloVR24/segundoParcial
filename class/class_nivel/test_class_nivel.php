<?php
include('class_nivel_dal.php');

// READ ONE (READ)
$obj_nivel = new catalogo_nivel_dal;
$resultado = $obj_nivel->datos_por_id(1);
if ($resultado == null) {
    echo "NO SE ENCONTRO REGISTRO";
} else {
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
}

// READ EVERYONE (READ)
$resultado2 = $obj_nivel->obtener_lista_niveles();
if ($resultado2 == null) {
    echo "NO SE ENCONTRO REGISTRO";
} else {
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
}

$obj_ins = new catalogo_nivel(null, "TERCERO");
$result_ins = $obj_nivel->inserta_nivel($obj_ins);
if ($result_ins == 1) {
    echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
}


$result_del = $obj_nivel->borrar_nivel(3);
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}

// UPDATE
$obj_upd = new catalogo_nivel("1", "PRUEBA");
$result_upd = $obj_nivel->actualizar_nivel($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO NIVEL</h2>";
}
