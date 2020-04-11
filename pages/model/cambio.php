<?php

include_once "conexion.php";

if ($_GET['action'] == 'create') {
    //print_r($_POST);
    $id_gamer = $_POST['Gamer'];
    $restantes = $_GET['m'] - $_POST['Aumento'];
    $usadas = $_POST['Aumento'];
    $motivo = $_POST['Motivo'];


    $stmt = Conexion::conectar()->prepare("INSERT INTO cambios_moneda (id_usuario, fecha, hora, cantidad_usada, cantidad_restante, motivo) VALUES (:id_gamer, DATE(NOW()), TIME(NOW()), :usadas, :restantes, :motivo)");

    $stmt->bindParam(":id_gamer", $id_gamer, PDO::PARAM_INT);
    $stmt->bindParam(":usadas", $usadas, PDO::PARAM_STR);
    $stmt->bindParam(":restantes", $restantes, PDO::PARAM_STR);
    $stmt->bindParam(":motivo", $motivo, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $actualizado = Conexion::conectar()->prepare("UPDATE usuarios SET monedas = :restantes WHERE id_usuario = :id_gamer");
        
        $actualizado->bindParam(":id_gamer", $id_gamer, PDO::PARAM_INT);
        $actualizado->bindParam(":restantes", $restantes, PDO::PARAM_STR);
        $actualizado->execute();

        $insertado = Conexion::conectar()->prepare("SELECT * FROM cambios_view ORDER BY id_cambio_moneda DESC LIMIT 1");
        $insertado->execute();
        print_r(json_encode($insertado->fetch()));
    } else {
        print_r($stmt->fetch());
    }
} elseif ($_GET['action'] == 'read') {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM cambios_view");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'update') {

    $id_gamer = $_POST['Gamer'];
    $monedas = $_GET['m'] + $_POST['Aumento'];

    $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET monedas = :monedas WHERE id_usuario = :id_gamer");

    $stmt->bindParam(":id_gamer", $id_gamer, PDO::PARAM_INT);
    $stmt->bindParam(":monedas", $monedas, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} elseif ($_GET['action'] == 'delete') {
    $stmt = Conexion::conectar()->prepare("UPDATE juegos SET estado = :estado  WHERE id_juego = :id_juego");

    $stmt->bindParam(":id_juego", $_GET["id_juego"], PDO::PARAM_INT);
    $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

    //echo $stmt->execute();
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    $stmt = Conexion::conectar()->prepare("SELECT id_usuario, nombre_usuario, CONCAT(nombre,' ',paterno,' ',materno) AS nombre, monedas FROM usuarios");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
}
