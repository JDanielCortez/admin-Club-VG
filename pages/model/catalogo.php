<?php

    include_once "conexion.php";

    if($_GET['action']=='create'){
        echo "Accion declarada pero no definida";
    }
    elseif($_GET['action']=='read'){
        $stmt = Conexion::conectar()->prepare("SELECT id_plataforma, nombre_plataforma FROM plataformas");	
        
        $stmt->execute();

        print_r(json_encode($stmt->fetchAll()));
        
    }elseif($_GET['action']=='update'){
        echo "Accion declarada pero no definida";
    }elseif($_GET['action']=='delete'){
        echo "Accion declarada pero no definida";
    }
?>