<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=videojuegos","root","DELAFUENTE7");
		return $link;

	}

}

?>