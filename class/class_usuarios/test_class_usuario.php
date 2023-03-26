<?php
include('class_usuario_dal.php');

// READ ONE (READ)
$obj_usuario = new catalogo_usuario_dal;
$resultado = $obj_usuario->datos_por_id(1);
if ($resultado == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
}

// READ EVERYONE (READ)
$resultado2 = $obj_usuario->obtener_lista_usuarios();
if ($resultado2 == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
}

/*
$obj_ins = new catalogo_usuario("The Administration", "Nick Jonas & The Administration", "onlyonealbum");
$result_ins = $obj_usuario->inserta_usuario($obj_ins);
if ($result_ins == 1) {
    echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
}
*/

$result_del = $obj_usuario->borrar_usuario("The Administration");
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}

// UPDATE
$obj_upd = new catalogo_usuario("JonasNick", "PRUEBA2");
$result_upd = $obj_usuario->actualizar_asunto($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO ASUNTO</h2>";

}

//existe curso
echo '<br>';
$result_exis = $obj_usuario->existe_usuario("JonasNick", "Jonas");
if ($result_exis == 1) {
    echo "<h2 style = 'color:green'>CURSO EXISTE</h2>";
} else {
    echo "<h2 style = 'color:red'>CURSO NO EXISTE</h2>";
}


?>