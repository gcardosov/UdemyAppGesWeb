<?php
/**
 * 
 */
//declaramos la clase conexion 
class Conexion
{
	
	//declaramos un funcion publica llamada conectar
	public function conectar(){
		//declaramos las variables que vamos a ocupar
		$localhost = "localhost";
		$database = "tienda_curso";
		$user = "root";
		$password = "";
		//construccion mediante pdo
		//que mierda es PDO
		$link = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);
		return $link;
	}
}
//declaramos un objeto de tipo conexion para comprobar que funciona nuestra clase
//$obj = new Conexion();
//$obj->conectar();
?>