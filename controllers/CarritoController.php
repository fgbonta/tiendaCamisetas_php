<?php 
	
	require_once 'models/Producto.php';
	
	class CarritoController {

		public function index()
		{
			echo 'controlador carrito, acción index';

			echo '<br>';
			var_dump(count($_SESSION['carrito']));
			echo '<br>';
			var_dump($_SESSION['carrito']);
		}

		public function add()
		{
			if(isset($_GET['id']))
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

		public function remove()
		{

		}

		public function delete_all()
		{
			unset($_SESSION['carrito']);
			header('Location:'.base_url.'Carrito/index');
		}

	}

 ?>