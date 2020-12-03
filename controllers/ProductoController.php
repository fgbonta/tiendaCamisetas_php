<?php

	require_once "models/Producto.php";

	class ProductoController {

		public function index()
		{
			require_once 'views/producto/destacados.php';
		}

		public function gestion()
		{
			Utils::isAdmin();
			$producto = new Producto();
			$productos = $producto->getAll();
			require_once 'views/producto/gestion.php';
		}

		public function crear()
		{
			Utils::isAdmin();
			require_once "views/producto/crear.php";
		}

		public function save()
		{
			Utils::isAdmin();

			if( $_SERVER['REQUEST_METHOD'] == "POST" )
			{					

				$nombre = isset($_POST['nombre'])? htmlspecialchars($_POST['nombre']) : false;
				$descripcion = isset($_POST['descripcion'])? htmlspecialchars($_POST['descripcion']) : false;
				$precio = isset($_POST['precio'])? $_POST['precio'] : false;
				$stock = isset($_POST['stock'])? $_POST['stock'] : false;
				$categoria = isset($_POST['categoria'])? $_POST['categoria'] : false;
				$file = isset($_FILES['image'])? $_FILES['image'] : false;
								
				$nombre = trim($nombre);
				if(empty($nombre)) $nombre = false;

				$descripcion = trim($descripcion);
				if(empty($descripcion)) $descripcion = false;

				if(!is_numeric($precio))
				{
					$precio = false;
				}

				if(!is_numeric($stock))
				{
					$stock = false;
				}

				if(!is_numeric($categoria))
				{
					$categoria = false;
				}								
				
				if($nombre && $descripcion && $precio>=0 && $stock>=0 && $categoria)
				{
					$producto = new Producto();

					$producto->setNombre($nombre);
					$producto->setDescripcion($descripcion);
					$producto->setPrecio($precio);
					$producto->setStock($stock);
					$producto->setCategoriaId($categoria);
					$producto->setOferta('no');

					if($file)
					{
						$fileName = $file['name'];
						$mimeType = $file['type'];

						if( $mimeType == "image/gif" || $mimeType == "image/png" || $mimeType == "image/jpeg" || $mimeType == "image/bmp" || $mimeType == "image/webp")
						{
							if(!is_dir('uploads/images'))
							{
								mkdir('uploads/images',0777,true);								
							}

							move_uploaded_file($file['tmp_name'], 'uploads/images/'.$fileName);

							$producto->setImagen($fileName);						
						}
					}					

					if( isset($_POST['id']) && is_numeric($_POST['id']))
					{
						$id = $_POST['id'];
						$producto->setId($id);
						$save = $producto->edit();
					}
					else
					{
						$save = $producto->save();
					}					

					if($save)
					{
						if( isset($_POST['id']) && is_numeric($_POST['id']))
							Utils::createSession('register','edit','complete');
						else
							Utils::createSession('register','create','complete');
					}
					else
					{
						if( isset($_POST['id']) && is_numeric($_POST['id']))
							Utils::createSession('register','edit','failed');
						else
							Utils::createSession('register','create','failed');
					}

				}
				else
				{
					if( isset($_POST['id']) && is_numeric($_POST['id']))
						Utils::createSession('register','edit','failed');
					else
						Utils::createSession('register','create','failed');
				}
			}
			
			header('Location:'.base_url.'Producto/gestion');
		}

		public function editar()
		{	
			Utils::isAdmin();

			if($_SERVER['REQUEST_METHOD']=='GET')
			{
				$id = isset($_GET['id'])? $_GET['id'] : false;

				if(empty($id))
				{
					$id = false;
				}

				if(!is_numeric($id))
				{
					$id = false;
				}

				if($id)
				{
					//$edit = true;
					$producto = new Producto();
					$producto->setId($id);
					$dataPro = $producto->getOne();	

					require_once "views/producto/crear.php";
				}
				else
				{
					header('Location:'.base_url.'Producto/gestion');
				}
			}
			else
			{
				header('Location:'.base_url.'Producto/gestion');
			}			
		}

		public function eliminar()
		{
			Utils::isAdmin();

			if($_SERVER['REQUEST_METHOD']=='GET')
			{
				$id = isset($_GET['id'])? $_GET['id'] : false;

				if(empty($id))
				{
					$id = false;
				}

				if(!is_numeric($id))
				{
					$id = false;
				}

				if($id)
				{
					$producto = new Producto();
					$producto->setId($id);
					
					$delete = $producto->delete();

					if($delete)
					{
						$_SESSION['delete'] = "complete";
					}
					else
					{
						$_SESSION['delete'] = "failed";
					}

				}
				else
				{
					$_SESSION['delete'] = "failed";
				}	

			}
			else
			{
				$_SESSION['delete'] = "failed";
			}

			header('Location:'.base_url.'Producto/gestion');
			
		}

	}