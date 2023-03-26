<?php
session_start();
session_destroy();

?>
<h1>La sesion ha sido finalizada</h1>
<a href="../views/admin/login.php">Iniciar Sesion</a>
<?php
exit();
?>