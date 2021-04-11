<?php 
	
	require_once 'models/Producto.php';
	
	class CarritoController {

		public function index()
		{	
			$carrito = isset($_SESSION['carrito'])? $_SESSION['carrito'] : false;
			require_once 'views/carrito/index.php';
		}

		public function add()
		{
			if(isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$product_id = $_GET['id'];
			}
			else
			{
				header('Location:'.base_url);
			}

			$result = false;
			if(isset($_SESSION['carrito']))
			{				
				foreach ($_SESSION['carrito'] as $clave => $valor) 
				{
					if( $product_id ==  $valor['id_producto'] )
					{
						$_SESSION['carrito'][$clave]['unidades']++;
						$result = true;
						break;
					}
				}
			}

			if(!isset($_SESSION['carrito']) || !$result)
			{
				$producto = new Producto();
				$producto->setId($product_id);
				$producto = $producto->getOne();				

				if(is_object($producto))
				{
					$_SESSION['carrito'][] = array(
						'id_producto'=>$producto->id,
						'precio'=>$producto->precio,
						'unidades'=>1,
						'producto'=>$producto
					);															
				}

			}

			header('Location:'.base_url.'Carrito/index');

		}

		public function delete()
		{
			if(isset($_GET['index'])){
				$index = $_GET['index'];
				unset($_SESSION['carrito'][$index]);
			}
			header('Location:'.base_url.'Carrito/index');
		}

		public function up()
		{
			if(isset($_GET['index'])){
				$index = $_GET['index'];
				$_SESSION['carrito'][$index]['unidades']++;
			}
			header('Location:'.base_url.'Carrito/index');
		}

		public function down()
		{
			if(isset($_GET['index'])){
				$index = $_GET['index'];
				$_SESSION['carrito'][$index]['unidades']--;
				if(!$_SESSION['carrito'][$index]['unidades']){
					unset($_SESSION['carrito'][$index]);
				}
			}
			header('Location:'.base_url.'Carrito/index');
		}

		public function delete_all()
		{
			unset($_SESSION['carrito']);
			header('Location:'.base_url.'Carrito/index');
		}

	}

 ?>