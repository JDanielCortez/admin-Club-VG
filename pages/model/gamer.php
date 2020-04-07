<?php

    include_once "conexion.php";

    if($_GET['action']=='create'){
        $id_tipo = 2;
        $nombre = $_POST['Nombre'];
        $paterno = $_POST['Apellido_paterno'];
        $materno = $_POST['Apellido_materno'];
        $nacimiento = $_POST['Nacimiento'];
        $genero = $_POST['Genero'];
        $telefono = $_POST['Telefono'];
        $usuario = $_POST['Nombre_de_usuario'];
        $contrasena = $_POST['Contraseña'];
        $correo = $_POST['Correo_electronico'];
        $foto = '../../dist/img/users_img/'.$nombre.$paterno.$materno.'.jpg';

        move_uploaded_file($_FILES['Foto_de_perfil']['tmp_name'], $foto);
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (id_tipo_usuario, nombre_usuario, contrasena, nombre, paterno, materno, fecha_nacimiento, genero, telefono, correo, foto) VALUES (:id_tipo_usuario, :nombre_usuario, :contrasena, :nombre, :paterno, :materno, :nacimiento, :genero, :telefono, :correo, :foto)");

        $stmt->bindParam(":id_tipo_usuario", $id_tipo, PDO::PARAM_INT);
        $stmt->bindParam(":nombre_usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":paterno", $paterno, PDO::PARAM_STR);
        $stmt->bindParam(":materno", $materno, PDO::PARAM_STR);
        $stmt->bindParam(":nacimiento", $nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(":genero", $genero, PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);

        if($stmt->execute()){
            $insertado = Conexion::conectar()->prepare("SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 1");
            $insertado->execute();
            print_r(json_encode($insertado->fetch()));
        }
        else{
            echo "error";
        }
    }
    elseif($_GET['action']=='read'){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios");	
        
        $stmt->execute();

        print_r(json_encode($stmt->fetchAll()));
        
    }elseif($_GET['action']=='update'){
        echo "Si acciones";
    }elseif($_GET['action']=='delete'){
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET estado = :estado  WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":id_usuario", $_GET["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $_GET["estado"], PDO::PARAM_INT);

        if($stmt->execute()){
            echo "success";
        } else{
            echo "error";
        }
    }
?>