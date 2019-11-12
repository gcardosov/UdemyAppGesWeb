<?php

require_once "ModeloJson.php";


/**
 * 
 */
class ControllerJson
{
	#USUARIOS

	//En la funcion pasamos los parametros de los usuario que queremos crear
	public function createUsuarioController($usuario, $password, $role, $mail)
	{
		$datosController = array("usuario"=>$usuario, 
								 "password"=>$password, 
								 "role"=>$role,
								 "mail"=>$mail
								);
		//Mandamos a llamar la funcion creacion usuario de la clase datos para que haga conexion con nuestro modelo directamente nos exije la tabla 
		$respuesta = Datos::createUsuariomodel($datosController, "usuarios");
		//regresamos lo que guardo con el modelo
		return $respuesta;

	}


		public function readUsuarioController()
	{

		$respuesta = Datos::readUsuariosModel("usuarios");
		return $respuesta;
		
	}




	public function loginUsuarioController($mail, $password)
	{
		$datosController = array('mail' => $mail,
								 'password' => $password

								);

		$respuesta = Datos::loginUsuariosModel($datosController, "usuarios");
		return $respuesta;

	}







} //cierre principal

$obj = new ControllerJson();
//creamos ahora los objetos desde el controlador no desde el modelo
$obj->readUsuarioController();


?>