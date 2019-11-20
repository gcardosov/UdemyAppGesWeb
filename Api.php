<?php

//vamos a ocupar algunas funciones del archivo ControllerJson.php
require_once 'ControllerJson.php';

//funcion que valida todos los parametros disponibles
//pasaremos los parametros requeridos a esta funcion 

function isTheseParameterAvailable($params)
{
	//suponiendo que todos los parametros estan disponibles
	//no ocurre niungun error
	$available = true;
	$$missingparams = "";

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
		$response['message'] = 'Paremetro' . substr($missingparams, 1, strlen($missingparams));
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

if(isset($_GET['apicall'])){

}else{
	//si no es un API el que se esta invocando 
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'Invalid API Call';
}

echo json_encode($response);








?>