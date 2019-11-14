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




	#CATEGORIAS
	//-------------------CRUD categorias Controller

	public function createCategoriaController($titulo)
	{
		//Mandamos a llamar la funcion creacion categoria  de la clase datos para que haga conexion con nuestro modelo directamente nos exije la tabla 
		$respuesta = Datos::createCategoriaModel($titulo, "categorias");
		//regresamos lo que guardo con el modelo
		return $respuesta;
	}

	public function readCategoriaController()
	{
		//Mandamos a llamar la funcion creacion categoria  de la clase datos para que haga conexion con nuestro modelo directamente nos exije la tabla 
		$respuesta = Datos::readCategoriasModel("categorias");
		//regresamos lo que guardo con el modelo
		return $respuesta;

	}


	public function updateCategoriaController($id, $titulo)
	{
		$datosController = array("id" => $id,
								 "titulo" => $titulo);

		$respuesta = Datos::updateCategoriaModel($datosController, "categorias");
		return $respuesta;

	}


	public function deleteCateriaController($id)
	{
		$respuesta = Datos::deleteCategoriaModel($id, "categorias");
		return $respuesta;

	}


#VENTAS
	///--------------CONTROL DE VENTAS

	public function createVentaController($usuario, $producto, $imagen, $costo, $fecha)
	{
		//posiciones unicas para guardar lo parametros de la funcion 
		$datosController = array('usuario' => $usuario, 
								 'producto' => $producto,
								 'imagen' => $imagen,	
								 'costo' => $costo,
								 'fecha' => $fecha				
								 );

		$respuesta = Datos::createVentasModel($datosController,"ventas");
		return $respuesta;

	}


	public function readVentasController()
	{
		$respuesta = Datos::readVentasModel("ventas");
		return $respuesta;

	}


	public function readVentasEspecificasController($usuario)
	{
		$respuesta = Datos::readVentasEspecificasModel($usuario, "ventas");
		return $respuesta;

	}



	#PRODUCTOS
	///--------------------------

	public function readProductosController()
	{
		$respuesta = Datos::readProductosModel("productos");
		return $respuesta;
	}


	public function deleteProductosController($id)
	{
		$respuesta = Datos::deleteProductosModel($id, "productos");
		return $respuesta;
	}


} //cierre principal


/*
$obj = new ControllerJson();
//creamos ahora los objetos desde el controlador no desde el modelo
//probamos las nuevas funciones desde el controller
//Comentamos esto en la leccion 24
$obj->readVentasController();
echo '------------------------------------------';
$obj->readVentasEspecificasController(2);
*/


?>