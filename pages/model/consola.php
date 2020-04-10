<?php

    include_once "conexion.php";

    if($_GET['action']=='create'){
        // print_r($_POST);
        $id_plataforma = $_POST['Plataforma'];
        $costo = $_POST['Costo'];
        $serial = $_POST['Serial'];
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO consolas (id_plataforma, costo_hora, serial) VALUES (:id_plataforma, :costo, :serial)");

        $stmt->bindParam(":id_plataforma", $id_plataforma, PDO::PARAM_INT);
        $stmt->bindParam(":costo", $costo, PDO::PARAM_STR);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);

        if($stmt->execute()){
            $insertado = Conexion::conectar()->prepare("SELECT c.id_consola, p.nombre_plataforma, c.serial, c.costo_hora, c.estado, p.id_plataforma FROM consolas c INNER JOIN plataformas p ON c.id_plataforma = p.id_plataforma ORDER BY c.id_consola DESC LIMIT 1");
            $insertado->execute();
            print_r(json_encode($insertado->fetch()));
        }
        else{
            echo "error";
        }
    }
    elseif($_GET['action']=='read'){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM consolas_view");	
        $stmt->execute();

        print_r(json_encode($stmt->fetchAll()));
        
    }elseif($_GET['action']=='update'){

        $id_consola = $_POST['id_consola'];
        $id_plataforma = $_POST['Plataforma'];
        $costo = $_POST['Costo'];
        $serial = $_POST['Serial'];

        $stmt = Conexion::conectar()->prepare("UPDATE consolas SET id_plataforma = :id_plataforma, costo_hora = :costo, serial = :serial WHERE id_consola = :id_consola");

        $stmt->bindParam(":id_consola", $id_consola, PDO::PARAM_INT);
        $stmt->bindParam(":id_plataforma", $id_plataforma, PDO::PARAM_INT);
        $stmt->bindParam(":costo", $costo, PDO::PARAM_STR);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);

        if($stmt->execute()){
            echo "success";
        } else{
            echo "error";
        }
    }elseif($_GET['action']=='delete'){
        $stmt = Conexion::conectar()->prepare("UPDATE consolas SET estado = :estado  WHERE id_consola = :id_consola");

        $stmt->bindParam(":id_consola", $_GET["id_consola"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

        if($stmt->execute()){
            echo "success";
        } else{
            echo "error";
        }
    }
?>