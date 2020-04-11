<?php

include_once "conexion.php";

if ($_GET['action'] == 'create') {
    echo "Sin acciones";
} elseif ($_GET['action'] == 'read') {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM monedas");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'update') {
    $id_moneda = $_POST['id_moneda'];
    $moneda = $_POST['Moneda'];

    $stmt = Conexion::conectar()->prepare("UPDATE monedas SET moneda = :moneda WHERE id_moneda = :id_moneda");

    $stmt->bindParam(":id_moneda", $id_moneda, PDO::PARAM_INT);
    $stmt->bindParam(":moneda", $moneda, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $modificado = Conexion::conectar()->prepare("SELECT * FROM monedas WHERE id_moneda = :id_moneda");
        $modificado->bindParam(":id_moneda", $id_moneda, PDO::PARAM_INT);
        $modificado->execute();

        print_r(json_encode($modificado->fetch()));
    } else {
        echo "error";
    } 
} elseif ($_GET['action'] == 'delete') {
    echo "Sin acciones";
} else {
    echo "Sin acciones";
}
