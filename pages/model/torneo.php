<?php

include_once "conexion.php";

if ($_GET['action'] == 'create') {
    //print_r($_POST);

    $stmt = Conexion::conectar()->prepare("INSERT INTO torneos (id_juego, id_modalidad, id_estatus, titulo, fecha, hora, max_jugadores, descripcion) VALUES (:id_juego, :id_modalidad, :id_estatus, :titulo, :fecha, :hora, :max_jugadores, :descripcion)");

    $stmt->bindParam(":id_juego", $_POST['Juego'], PDO::PARAM_INT);
    $stmt->bindParam(":id_modalidad", $_POST['Modalidad'], PDO::PARAM_INT);
    $stmt->bindParam(":id_estatus", $_POST['Estatus'], PDO::PARAM_INT);
    $stmt->bindParam(":titulo", $_POST['Titulo'], PDO::PARAM_STR);
    $stmt->bindParam(":fecha", $_POST['Fecha'], PDO::PARAM_STR);
    $stmt->bindParam(":hora", $_POST['Hora'], PDO::PARAM_STR);
    $stmt->bindParam(":max_jugadores", $_POST['Jugadores'], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $_POST['Descripcion'], PDO::PARAM_STR);

    if ($stmt->execute()) {
        $insertado = Conexion::conectar()->prepare("SELECT * FROM torneos_view ORDER BY id_torneo DESC LIMIT 1");
        $insertado->execute();
        print_r(json_encode($insertado->fetch()));
    } else {
        print_r($stmt->fetch());
    }
} elseif ($_GET['action'] == 'read') {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM torneos_view");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'update') {

    $id_juego = $_POST['id_juego'];
    $id_consola = $_POST['Consola'];
    $titulo = $_POST['Titulo'];

    if ($_FILES['Imagen']['tmp_name'] != '') {
        $foto = '../../dist/img/juegos_img/' . $titulo . '.jpg';
        move_uploaded_file($_FILES['Imagen']['tmp_name'], $foto);
        $sql = "UPDATE juegos SET titulo = :titulo, imagen = :imagen WHERE id_juego = :id_juego";
    } else {
        $sql = "UPDATE juegos SET titulo = :titulo WHERE id_juego = :id_juego";
    }

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
    $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
    if ($_FILES['Imagen']['tmp_name'] != '') {
        $stmt->bindParam(":imagen", $foto, PDO::PARAM_STR);
    }

    if ($stmt->execute()) {
        $jc = Conexion::conectar()->prepare("UPDATE consola_juego SET id_consola = :id_consola WHERE id_juego = :id_juego");
        $jc->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
        $jc->bindParam(":id_consola", $id_consola, PDO::PARAM_INT);
        $jc->execute();

        $modificado = Conexion::conectar()->prepare("SELECT * FROM juegos_view WHERE id_juego = :id_juego");
        $modificado->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
        $modificado->execute();

        print_r(json_encode($modificado->fetch()));
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
} elseif ($_GET['action'] == 'read-juegos') {
    $stmt = Conexion::conectar()->prepare("SELECT id_juego, titulo FROM juegos");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'read-modalidades') {
    $stmt = Conexion::conectar()->prepare("SELECT id_modalidad, nombre_modalidad FROM modalidad");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} elseif ($_GET['action'] == 'read-status') {
    $stmt = Conexion::conectar()->prepare("SELECT id_estatus, nombre_estatus FROM estatus");
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
}
