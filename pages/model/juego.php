<?php

    include_once "conexion.php";

    if($_GET['action']=='create'){
        // print_r($_POST);
        $titulo = $_POST['Titulo'];
        $foto = '../../dist/img/juegos_img/'.$titulo.'.jpg';

        move_uploaded_file($_FILES['Imagen']['tmp_name'], $foto);
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO juegos (titulo, imagen) VALUES (:titulo, :imagen)");

        $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $foto, PDO::PARAM_STR);

        if($stmt->execute()){
            //$stmt = null;
            $ultimo_id = Conexion::conectar()->prepare("SELECT MAX(id_juego) as id FROM juegos");
            $ultimo_id->execute();
            $id = $ultimo_id->fetch();
            
            //print_r($id);

            $consola = Conexion::conectar()->prepare("INSERT INTO consola_juego (id_consola, id_juego) VALUES (:id_consola, :id_juego)");

            $consola->bindParam(":id_consola", $_POST['Consola'], PDO::PARAM_INT);
            $consola->bindParam(":id_juego", $id['id'], PDO::PARAM_INT);
           
            $consola->execute();


            $insertado = Conexion::conectar()->prepare("SELECT * FROM juegos_view ORDER BY id_juego DESC LIMIT 1");
            $insertado->execute();
            print_r(json_encode($insertado->fetch()));
        }
        else{
            print_r ($stmt->fetch());
        }
    }
    elseif($_GET['action']=='read'){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM juegos_view");	
        $stmt->execute();

        print_r(json_encode($stmt->fetchAll()));
        
    }elseif($_GET['action']=='update'){

        $id_juego = $_POST['id_juego'];
        $id_consola = $_POST['Consola'];
        $titulo = $_POST['Titulo'];

        if($_FILES['Imagen']['tmp_name'] != ''){
            $foto = '../../dist/img/juegos_img/'.$titulo.'.jpg';
            move_uploaded_file($_FILES['Imagen']['tmp_name'], $foto);
            $sql = "UPDATE juegos SET titulo = :titulo, imagen = :imagen WHERE id_juego = :id_juego";
        }else{
            $sql = "UPDATE juegos SET titulo = :titulo WHERE id_juego = :id_juego";
        }

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        if($_FILES['Imagen']['tmp_name'] != ''){
            $stmt->bindParam(":imagen", $foto, PDO::PARAM_STR);
        }

        if($stmt->execute()){
            $jc = Conexion::conectar()->prepare("UPDATE consola_juego SET id_consola = :id_consola WHERE id_juego = :id_juego");
            $jc->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
            $jc->bindParam(":id_consola", $id_consola, PDO::PARAM_INT);
            $jc->execute();

            $modificado = Conexion::conectar()->prepare("SELECT * FROM juegos_view WHERE id_juego = :id_juego");
            $modificado->bindParam(":id_juego", $id_juego, PDO::PARAM_INT);
            $modificado->execute();

            print_r(json_encode($modificado->fetch()));
        } else{
            echo "error";
        }
    }elseif($_GET['action']=='delete'){
        $stmt = Conexion::conectar()->prepare("UPDATE juegos SET estado = :estado  WHERE id_juego = :id_juego");

        $stmt->bindParam(":id_juego", $_GET["id_juego"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

        //echo $stmt->execute();
        if($stmt->execute()){
            echo "success";
        } else{
            echo "error";
        }
    }else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM consolas_view");	
        $stmt->execute();

        print_r(json_encode($stmt->fetchAll()));
    }
