<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=videojuegos","root","root1234");
		return $link;

	}

}

?>