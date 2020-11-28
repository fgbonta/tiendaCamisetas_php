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

				$nombre = isset($_POST['nombre'])? $_POST['nombre'] : false;
				$descripcion = isset($_POST['descripcion'])? $_POST['descripcion'] : false;
				$precio = isset($_POST['precio'])? $_POST['precio'] : false;
				$stock = isset($_POST['stock'])? $_POST['stock'] : false;
				$categoria = isset($_POST['categoria'])? $_POST['categoria'] : false;
				//$image = isset($_FILES['image'])? $_FILES['image'] : false;
				
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

				$file = isset($_FILES['image'])? $_FILES['image'] : false;				
				
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

					$save = $producto->save();

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

			header('Location:'.base_url.'Producto/gestion');
		}

		public function editar()
		{
			var_dump($_GET);
		}

		public function eliminar()
		{
			var_dump($_GET);
		}

	}