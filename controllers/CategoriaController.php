<?php

	require_once 'models/Categoria.php';
	require_once 'models/Producto.php';

	class CategoriaController {

		public function index()
		{	
			Utils::isAdmin();
			$categoria = new Categoria();
			$categorias = $categoria->getAll();

			require_once 'views/categoria/index.php';
		}

		public function ver()
		{	
			if(isset($_GET['id']))
			{	
				//conseguir la categoria			
				$id = $_GET['id'];
				$categoria = new Categoria();
				$categoria->setId($id);
				$categoria = $categoria->getOne();
				//conseguir los productos de esa categoria
				$productos = new Producto();
				$productos->setCategoriaId($id);
				$productos = $productos->getAllCategory();

			}
			require_once 'views/categoria/ver.php';
		}

		public function crear()
		{
			Utils::isAdmin();
			require_once 'views/categoria/crear.php';
		}

		public function save()
		{
			Utils::isAdmin();

			if( $_SERVER['REQUEST_METHOD'] == "POST" )
			{
				$nombre = isset($_POST['nombre'])? htmlspecialchars($_POST['nombre']) : false;

				$nombre = trim($nombre);

				if(empty($nombre))
				{
					$nombre=false;
				}

				if($nombre)
				{
					$categoria = new Categoria();
					$categoria->setNombre($nombre);
					$save = $categoria->save();
					
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

			header('Location:'.base_url.'Categoria/index');

		}

	}