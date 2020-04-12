<?php
include_once "conexion.php";

if ($_GET['action'] == 'iniciar') {
    $usuario = $_POST['Usuario'];
    $pass = $_POST['Contrasena'];

    $stmt = Conexion::conectar()->prepare("SELECT u.id_usuario, u.nombre_usuario, u.id_tipo_usuario, t.nombre_tipo_usuario, u.contrasena FROM usuarios u JOIN tipos_usuario t ON u.id_tipo_usuario = t.id_tipo_usuario WHERE u.nombre_usuario = :usuario");

    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $usuario = $stmt->fetch();
        if ($usuario['contrasena'] == $pass) {
            session_start();
            $_SESSION["validar"] = 'validar';
            $_SESSION["usuario"] = $usuario['nombre_usuario'];
            $_SESSION["nivel"] = $usuario['nombre_tipo_usuario'];
            //header("Location: ../admin/dashboard.php");
        } else {
            echo "incorrectos";
        }
    } else {
        echo "error";
    }
}else{
    $_SESSION['validar'] = '';
    $_SESSION["usuario"] = '';
    $_SESSION["nivel"] = '';
    $_SESSION = null;
    session_destroy();
}
?>
