<?php

include_once "conexion.php";

if ($_GET['action'] == 'create') {
    // print_r($_POST);
    $accesorio = $_POST['Accesorio'];
    $costo = $_POST['Costo'];

    $stmt = Conexion::conectar()->prepare("INSERT INTO accesorios (id_tipo_accesorio, costo) VALUES (:accesorio, :costo)");

    $stmt->bindParam(":accesorio", $accesorio, PDO::PARAM_STR);
    $stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $insertado = Conexion::conectar()->prepare("SELECT * FROM accesorios_view ORDER BY id_accesorio DESC LIMIT 1");
        $insertado->execute();
        print_r(json_encode($insertado->fetch()));
    } else {
        print_r($stmt->fetch());
    }
} elseif ($_GET['action'] == 'read') {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM accesorios_view");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'update') {

    $id_accesorio = $_POST['id_accesorio'];
    $id_tipo = $_POST['Accesorio'];
    $costo = $_POST['Costo'];

    $stmt = Conexion::conectar()->prepare("UPDATE accesorios SET id_tipo_accesorio = :id_tipo, costo = :costo WHERE id_accesorio = :id_accesorio");

    $stmt->bindParam(":id_accesorio", $id_accesorio, PDO::PARAM_INT);
    $stmt->bindParam(":id_tipo", $id_tipo, PDO::PARAM_INT);
    $stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $modificado = Conexion::conectar()->prepare("SELECT * FROM accesorios_view WHERE id_accesorio = :id_accesorio");
        $modificado->bindParam(":id_accesorio", $id_accesorio, PDO::PARAM_INT);
        $modificado->execute();

        print_r(json_encode($modificado->fetch()));
    } else {
        echo "error";
    }
} elseif ($_GET['action'] == 'delete') {
    $stmt = Conexion::conectar()->prepare("UPDATE accesorios SET estado = :estado  WHERE id_accesorio = :id_accesorio");

    $stmt->bindParam(":id_accesorio", $_GET["id_accesorio"], PDO::PARAM_INT);
    $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

    //echo $stmt->execute();
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM tipos_accesorios");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
}
