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
    $stmt = Conexion::conectar()->prepare("SELECT * FROM torneos_view WHERE id_torneo = :id_torneo");
    $stmt->bindParam(":id_torneo", $_GET['torneo'],PDO::PARAM_STR);
    $stmt->execute();

    print_r(json_encode($stmt->fetch()));
} elseif ($_GET['action'] == 'update') {
    //print_r($_POST);

    $stmt = Conexion::conectar()->prepare("UPDATE torneos SET titulo = :titulo, id_juego = :id_juego, id_modalidad = :id_modalidad, id_estatus = :id_estatus, fecha = :fecha, hora = :hora, max_jugadores = :max_jugadores, descripcion = :descripcion WHERE id_torneo = :id_torneo");

    $stmt->bindParam(":id_torneo", $_POST['id_torneo'], PDO::PARAM_INT);
    $stmt->bindParam(":titulo", $_POST['Titulo'], PDO::PARAM_STR);
    $stmt->bindParam(":id_juego", $_POST['Juego'], PDO::PARAM_INT);
    $stmt->bindParam(":id_modalidad", $_POST['Modalidad'], PDO::PARAM_INT);
    $stmt->bindParam(":id_estatus", $_POST['Estatus'], PDO::PARAM_INT);
    $stmt->bindParam(":fecha", $_POST['Fecha'], PDO::PARAM_STR);
    $stmt->bindParam(":hora", $_POST['Hora'], PDO::PARAM_STR);
    $stmt->bindParam(":max_jugadores", $_POST['Jugadores'], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $_POST['Descripcion'], PDO::PARAM_STR);

    if ($stmt->execute()) {
        $modificado = Conexion::conectar()->prepare("SELECT * FROM torneos_view WHERE id_torneo = :id_torneo");
        $modificado->bindParam(":id_torneo", $_POST['id_torneo'], PDO::PARAM_INT);
        $modificado->execute();

        print_r(json_encode($modificado->fetch()));
    } else {
        echo "error";
    }
} elseif ($_GET['action'] == 'delete') {
    $stmt = Conexion::conectar()->prepare("UPDATE torneos SET estado = :estado  WHERE id_torneo = :id_torneo");

    $stmt->bindParam(":id_torneo", $_GET["id_torneo"], PDO::PARAM_INT);
    $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

    //echo $stmt->execute();
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} elseif ($_GET['action'] == 'premios') {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM premios WHERE id_torneo= :id_torneo");
    $stmt->bindParam(":id_torneo", $_GET['torneo'],PDO::PARAM_STR);
    $stmt->execute();

    print_r(json_encode($stmt->fetchAll()));
} 