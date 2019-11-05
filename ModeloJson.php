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
	
	public function createUsuarioModel($tabla){
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

//Metodo que va leer usuarios 
	public function readUsuariosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, role, mail FROM $tabla");
		
		//vamos a llamar al metodo execute para ver si la sentencia se ejecuto correctamente 
		$stmt->execute();

		//llamamos al metodo bindColumn para llamar a los atributos de la tabla y se hace para cada uno de los campos
		//para leer tenemos que guardar en variables digamos auxiliares
		$stmt->bindColumn("id",$id);
		$stmt->bindColumn("usuario",$usuario);
		$stmt->bindColumn("password",$password);
		$stmt->bindColumn("role",$role);
		$stmt->bindColumn("mail",$mail);


		//es una array para guardar los atributos en cada una de las posiciones
		$usuarios = array();
		//bound es un patrametro de PDO

			//probamos el funcionamiento 
			//creamos una talba 

			//Primer echo 
			echo '
			<table>
			<tr>
			<td><strong>id</strong></td>
			<td><strong>usuario</strong></td>
			<td><strong>password</strong></td>
			<td><strong>role</strong></td>
			<td><strong>mail</strong></td>
			 ';


			 //Nuestro while es el encargado de mostrar los campos de los usuarios

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){

			$user = array();
			//le vamos pasando los atributos en codigficacion UTF8 por si tenemops algun caracter que no se encuentre en ingles como la ñ
			//cada atributo es una posicion en el array user
			$user["id"] = utf8_decode($id);
			$user["usuario"] = utf8_decode($usuario);
			$user["password"] = utf8_decode($password);
			$user["role"] = utf8_decode($role);
			$user["mail"] = utf8_decode($mail);

			//Para enviar las informacion 
			//guardamos el array users 
			//y acceder a ellos con estos arrays

			array_push($usuarios, $user);

			//Segundo echo 
			echo '
			<tr>
			<td>'.$user['id'].'</td>	
			<td>'.$user['usuario'].'</td>	
			<td>'.$user['password'].'</td>	
			<td>'.$user['role'].'</td>	
			<td>'.$user['mail'].'</td>	
			';

		}


			echo '</table>';

					//retornamos nuestro array principal usuarios
			return $usuarios;

	}


	public function loginUsuariosModel($tabla){


		//en la setencia sql solo traemos al usuario selecionado
		$stmt = Conexion::conectar()->prepare ("SELECT id, usuario, password, role, mail FROM  $tabla WHERE mail = :mail AND password = :password"); 

		//probamos con las variables auxiliares
		$mail = "aritza@cursos.com";
		$password = "1234";




		//llamamos al objeto bindParam y le pasamos el correo y el password como en el create
		$stmt->bindParam(":mail", $mail);
		$stmt->bindParam(":password", $password);

		//parachecar que todo salga bien 
		$stmt->execute();

		//para guardar los parametros completos del usuario con el que nos logueamos
		$stmt->bindColumn("id",$id);
		$stmt->bindColumn("usuario",$usuario);
		$stmt->bindColumn("password",$password);
		$stmt->bindColumn("role",$role);
		$stmt->bindColumn("mail",$mail);

		//Primer echo 
		//verificar
		echo'
		<table>
		<tr>
		<td><strong>id</strong></td>
		<td><strong>usuarios</strong></td>
		<td><strong>password</strong></td>
		<td><strong>role</strong></td>
		<td><strong>mail</strong></td>
		';
			



		//el while se encarga de mostrar los campos del usuario en pantalla
		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){

			$user = array();
			//le vamos pasando los atributos en codigficacion UTF8 por si tenemops algun caracter que no se encuentre en ingles como la ñ
			//cada atributo es una posicion en el array user
			$user["id"] = utf8_encode($id);
			$user["usuario"] = utf8_encode($usuario);
			$user["password"] = utf8_encode($password);
			$user["role"] = utf8_encode($role);
			$user["mail"] = utf8_encode($mail);

			//Para enviar las informacion 
			//guardamos el array users 
			//y acceder a ellos con estos arrays


			//Segundo echo 
			echo '
			<tr>
			<td>'.$user['id'].'</td>	
			<td>'.$user['usuario'].'</td>	
			<td>'.$user['password'].'</td>	
			<td>'.$user['role'].'</td>	
			<td>'.$user['mail'].'</td>	
			';

		}

		//validacion de la variable user si es diferente a vacio nos regresa el valor de la variable si no nos muestra un falso
		if(!empty($user)){
			return $user;
		}else{
			return false;

			}	


		}



		//CRUD para las categorias


		public function createCategoriaModel($tabla){

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo) VALUES (:titulo)");
			//variables de apoyo
			$titulo = "PERFUMES";

		
			$stmt->bindParam(":titulo", $titulo,PDO::PARAM_STR);

		
			if($stmt->execute()){
				echo "registro exitoso";
			}else{
				echo "no se puede hacer el registro";
			}



		}


		public function readCategoriasModel($tabla){

			$stmt = Conexion::conectar()->prepare("SELECT id, titulo FROM $tabla");
		
		//vamos a llamar al metodo execute para ver si la sentencia se ejecuto correctamente 
		$stmt->execute();

		//llamamos al metodo bindColumn para llamar a los atributos de la tabla y se hace para cada uno de los campos
		//para leer tenemos que guardar en variables digamos auxiliares
		$stmt->bindColumn("id",$id);
		$stmt->bindColumn("titulo",$titulo);
	
		//es una array para guardar los atributos en cada una de las posiciones
		$categorias = array();
		//bound es un patrametro de PDO

			//probamos el funcionamiento 
			//creamos una talba 

			//Primer echo 
			echo '
			<table>
			<tr>
			<td><strong>id</strong></td>
			<td><strong>titulo</strong></td>
			 ';


			 //Nuestro while es el encargado de mostrar los campos de los usuarios

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){

			$cat = array();
			//le vamos pasando los atributos en codigficacion UTF8 por si tenemops algun caracter que no se encuentre en ingles como la ñ
			//cada atributo es una posicion en el array user
			$cat["id"] = utf8_encode($id);
			$cat["titulo"] = utf8_encode($titulo);


			//Para enviar las informacion 
			//guardamos el array users 
			//y acceder a ellos con estos arrays

			array_push($categorias, $cat);

			//Segundo echo 
			echo '
			<tr>
			<td>'.$cat['id'].'</td>	
			<td>'.$cat['titulo'].'</td>	
			';

		}


			echo '</table>';

					//retornamos nuestro array principal usuarios
			return $categorias;




		}


		public function updateCategoriaModel($tabla){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla  SET titulo = :titulo WHERE id = :id");
			//variables de apoyo
			$id = 17;
			$titulo = "FUNDAS DE TELEFONO";

			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);

		
			if($stmt->execute()){
				echo "actualización exitosa";
			}else{
				echo "no se puede hacer la actualización registro";
			}

		}


		public function deleteCategoriaModel($id, $tabla){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
			$stmt->bindParam("id", $id, PDO::PARAM_INT);


			if($stmt->execute()){
				echo"Categoria eliminada exitosamente";
			}else{
				echo "La categoria no pudo ser eliminada";

		
			}
		
		}
	
	}





//mandamos a llamar un nuevo objeto de la clase Datos que hereda de conexion 
$obj = new Datos();
//pasamos el parametro de la tabla usuario para la funcion crear usuario que gracias al prepare nos deja insertar el codigo sql 
//cuanto estanciones nuestro objeto y le pasamos cada funcion para comprobar su funcionamiento 

$obj->deleteCategoriaModel(17, "categorias");
?>