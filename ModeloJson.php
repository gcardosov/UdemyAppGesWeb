<?php
require_once "Conexion.php";
//verifica que el archivo haya sido incluido 
//para encontrar el otro archivo 
/**
 * 
 */
class Datos extends Conexion 
//nuestra nueva clase hereda de la clase de nuestro otro archivo
{
	
	public function createUsuario($tabla){
		//le pasamos el parametro que sera tabla 
		//
		//prepare sirve para escribir sentencias SQL
		//llamamos a la funcion conectar
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, role, mail) VALUES (:usuario, :password, :role, :mail)");
		//variables de apoyo
		$usuario = "Gerardo";
		$password = "4321";
		$role = "Administrador";
		$mail = "gcardoso@gmail.com";
		$stmt->bindParam(":usuario", $usuario,PDO::PARAM_STR);
		$stmt->bindParam(":password", $password,PDO::PARAM_STR);
		$stmt->bindParam(":role", $role,PDO::PARAM_STR);
		$stmt->bindParam(":mail", $mail,PDO::PARAM_STR);
		if($stmt->execute()){
				echo "registro exitoso";
		}else{
				echo "no se puede hacer el registro";
		}
	}
}
//mandamos a llamar un nuevo objeto de la clase Datos que hereda de conexion 
$obj = new Datos();
//pasamos el parametro de la tabla usuario para la funcion crear usuario que gracias al prepare nos deja insertar el codigo sql 
$obj->createUsuario("usuarios");
?>