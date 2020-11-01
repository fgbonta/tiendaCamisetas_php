<?php

	require_once 'models/Usuario.php';

	class UsuarioController {

		public function index()
		{
			echo "Controlador Usuarios, Acción index";
		}

		public function registro()
		{
			require_once 'views/usuario/registro.php';
		}

		public function save()
		{
			if( $_SERVER['REQUEST_METHOD'] == 'POST' )
			{

				$nombre = isset($_POST['nombre'])? $_POST['nombre'] : false;
				$apellidos = isset($_POST['apellidos'])? $_POST['apellidos'] : false;
				$email = isset($_POST['email'])? $_POST['email'] : false;
				$password = isset($_POST['password'])? $_POST['password'] : false;

				$email = filter_var($email,FILTER_VALIDATE_EMAIL);

				if($nombre && $apellidos && $email && $password)
				{
					$usuario = new Usuario();

					$usuario->setNombre($nombre);
					$usuario->setApellidos($apellidos);
					$usuario->setEmail($email);
					$usuario->setPassword($password);
					
					/*echo '<pre>';
					var_dump($usuario);
					echo '</pre>';*/

					$save = $usuario->save();

					if($save)
					{
						$_SESSION['register'] = "complete";
					}
					else
					{
						$_SESSION['register'] = "failed";
					}
				}
				else
				{
					$_SESSION['register'] = "failed";
				}
				

			}
			else
			{
				$_SESSION['register'] = "failed";
			}

			header('Location:'.base_url.'Usuario/registro');
		}

	}

?>