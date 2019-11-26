<?php

//vamos a ocupar algunas funciones del archivo ControllerJson.php
require_once 'ControllerJson.php';

//funcion que valida todos los parametros disponibles
//pasaremos los parametros requeridos a esta funcion 

function isTheseParametersAvailable($params)
{
	//suponiendo que todos los parametros estan disponibles
	//no ocurre niungun error
	$available = true;
	$missingparams = "";

	foreach ($params as $param) {
		if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
			$available = false;

			$missingparams = $missingparams . ", " . $param;
		}
	}

	//si faltan parametros
	if(!$available){
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Paremetro' . substr($missingparams, 1, strlen($missingparams)) .' vacio';
		//error de visualizacion 
		echo json_encode($response);
		//detener la ejecucion adicional
		die();
		//cuando terminamos esta funcion no tuvimos manera de comprobar su funcionamiento 

	}

}

//una matriz para mostrar las respuestas de nuestro API
$response = array();

//si se trata de una llamada API 
//que significa que un parametro get llamado se establece en la URL
//y con estos parametros estamos concluyendo que es una llamda API

if(isset($_GET['apiCall'])){
	//Aqui iran todos los llamados 
	switch ($_GET['apiCall']) {
		//Operacion createUsuario
		case 'createUsuario':
			//primero se verifican parametros 
			//pasamos las posiciones vacias 
			isTheseParametersAvailable(array('usuario', 'password', 'role', 'mail'));
			//llamamos a la clase controladorJson
			$db = new ControllerJson();
			$result = $db->createUsuarioController($_POST['usuario'],
												   $_POST['password'],
												   $_POST['role'],
												   $_POST['mail']
												   );

			if($result){
				//esto significa que no hay ningun error
				$response ['error']= false;
				//mensaje que se ejecuto correctamente 
				$response ['message'] = 'Usuario agregado correctamente';
				//para actualizar en tiempo real la lista de usuarios cuando agregamos uno 
				$response['contenido'] = $db->readUsuariosController();

			}else{
				$response ['error']= true;
				//mensaje que se ejecuto correctamente 
				$response ['message'] = 'Ocurrio un error intentar nuevamente';

			}

			break;

			case 'readUsuarios':
				$db = new ControllerJson();
				$response['error'] = false;
				$response['message'] = 'Solicitud completada correctamente';
				$response['contenido'] = $db->readUsuariosController();
 				break;


 			case 'loginUsuario';
 			isTheseParametersAvailable(array('mail','password'));
 			
 			$db = new ControllerJson();

 			$result = $db->loginUsuarioController($_POST['mail'], $_POST['password']);
 			if(!$result){
 				$response['error'] = true;
 				$response['message'] = 'Credenciales no validas';
 				
 			}else{
 				$response['error'] = false;
 				$response['message'] = 'Bienvenido';
 				$response['contenido'] = $result;
 			}
 			break;


 			//CRUD Categorias 

 			case 'createCategoria':
 			//pasamos las posiciones vacias 
			isTheseParametersAvailable(array('titulo'));
			//llamamos a la clase controladorJson
			$db = new ControllerJson();
			$result = $db->createCategoriaController($_POST['titulo']
												   );

			if($result){
				//esto significa que no hay ningun error
				$response ['error']= false;
				//mensaje que se ejecuto correctamente 
				$response ['message'] = 'Categoria agregada correctamente';
				//para actualizar en tiempo real la lista de usuarios cuando agregamos uno 
				$response['contenido'] = $db->readCategoriasController();

			}else{
				$response ['error']= true;
				//mensaje que se ejecuto correctamente 
				$response ['message'] = 'Ocurrio un error intentar nuevamente';

			}

 				break;

 			case 'readCategorias':

 				$db = new ControllerJson();
				$response['error'] = false;
				$response['contenido'] = $db->readCategoriasController();
 				
 				break;
	

 			case 'updateCategorias':

				isTheseParametersAvailable(array('id','titulo'));

				$db = new ControllerJson();

				$result = $db->updateCategoriaController($_POST['id'], $_POST['titulo']);

				if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'categoria editada correctamente';

				$response['contenido'] = $db->readCategoriasController();
				}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
				} 			


 				break;


 			case 'deleteCategorias':

 			if(isset($_GET['id']) && !empty($_GET['id'])){

 				$db = new ControllerJson();
 				if($db->deleteCateriaController($_GET['id'])){
 				$response['error'] = false;
 				$response['message'] = 'Categoria eliminada';
 				$response['contenido'] = $db->readCategoriasController();
 				}else{
 					$response['error'] = true;
 					$response['message'] = 'La categoria no fue eliminada';

 				}
 			
 			}
 				
 				break; 			


 			case 'createVenta':
 			
 			isTheseParametersAvailable(array('usuario', 'producto', 'imagen', 'costo', 'fecha'));

 			$db = new ControllerJson();
 			$result = $db->createVentaController($_POST['usuario'], $_POST['producto'], $_POST['imagen'], $_POST['costo'], $_POST['fecha']);

 			if($result){
 				$response['error'] = false;
 				$response['message'] = 'Venta realizada correctamente';
 				$response['contenido'] = $db -> readVentasController();
 			}else{
 				$response['error'] = true;
 				$response['message'] = 'Ha ocurrido un error con la venta, favor de intentarlo de nuevo';
 			}


 			break;		


 			case 'readVentas':

 				$db = new ControllerJson();
				$response['error'] = false;
				$response['contenido'] = $db->readVentasController();

			break;



			case 'readVentasEspecificas':

			if(isset($_GET['usuario']) && !empty($_GET['usuario'])){
				$db = new ControllerJson();
				$response['error'] = false;
				$response['message'] = 'Solicitud completada correctamente';
				$response['contenido'] = $db->readVentasEspecificasController($_GET['usuario']);

			}else{
				$response['error'] = true;
				$response['message'] = 'La solicitud no pudo realizarce';

			}



			break;

	}



}else{
	//si no es un API el que se esta invocando 
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'Invalid API Call';
}

echo json_encode($response);








?>