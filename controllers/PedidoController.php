<?php

	require_once 'models/Pedido.php';	

	class PedidoController {

		public function hacer()
		{
			require_once 'views/pedido/hacer.php';
		}

		public function add()
		{
			
			if( isset($_SESSION['identity']) && $_SERVER['REQUEST_METHOD'] == "POST" )
			{
				
				$provincia = isset($_POST['provincia'])? trim(htmlspecialchars($_POST['provincia'])) : false;
				$localidad = isset($_POST['localidad'])? trim(htmlspecialchars($_POST['localidad'])) : false;
				$direccion = isset($_POST['direccion'])? trim(htmlspecialchars($_POST['direccion'])) : false;

				if(empty($provincia))
				{
					$provincia = false;
				}

				if(empty($localidad))
				{
					$localidad = false;
				}

				if(empty($direccion))
				{
					$direccion = false;
				}

				if($provincia && $localidad && $direccion)
				{

					$pedido = new Pedido();
					$pedido->setUsuarioId($_SESSION['identity']->id);
					$pedido->setProvincia($provincia);
					$pedido->setLocalidad($localidad);
					$pedido->setDireccion($direccion);
					$pedido->setCoste(Utils::statsCarrito()['total']);

					$save = $pedido->save();

					$save_linea = $pedido->save_linea();

					if($save && $save_linea)
					{
						$_SESSION['pedido'] = 'complete';
						require_once 'models/Producto.php';
						foreach ($_SESSION['carrito'] as $clave => $valor) 
						{
							$producto = new Producto();
							$producto->setID($valor['id_producto']);
							$producto->downStock($valor['unidades']);							
						}
						unset($_SESSION['carrito']);
					}
					else
					{
						$_SESSION['pedido'] = 'failed';
					}

				}
				else
				{
					$_SESSION['pedido'] = 'failed';
				}
				
				header('Location:'.base_url.'Pedido/confirmado');				

			}
			else
			{
				header('Location:'.base_url);
			}			

		}

		public function confirmado()
		{
			if(isset($_SESSION['identity']))
			{
				$identity = $_SESSION['identity'];

				$pedido = new Pedido();
				$pedido->setUsuarioId($identity->id);
				$pedido = $pedido->getOneByUser();

				$pedido_productos = new Pedido();
				$productos = $pedido_productos->getProductosByPedido($pedido->id);
			}

			require_once 'views/pedido/confirmado.php';
		}

		public function mis_pedidos()
		{
			Utils::isIdentity();

			$pedido = new Pedido();
			$pedido->setUsuarioId($_SESSION['identity']->id);
			$pedidos = $pedido->getAllByUser();

			require_once 'views/pedido/mis_pedidos.php';
		}

		public function detalle()
		{
			Utils::isIdentity();

			if(isset($_GET['id']) && is_numeric($_GET['id']))
			{
				$id = $_GET['id'];

				$pedido = new Pedido();
				$pedido->setId($id);
				$pedido = $pedido->getOne();

				$productos = new Pedido();
				$productos = $productos->getProductosByPedido($pedido->id);

				require_once 'models/Usuario.php';
				$usuario = new Usuario();
				$usuario->setId($pedido->usuario_id);
				$usuario = $usuario->getUserById();

				require_once 'views/pedido/detalle.php';

			}
			else
			{
				header('Location:'.base_url.'Pedido/mis_pedidos');
			}
			
		}

		public function gestion()
		{
			Utils::isAdmin();
			$gestion = true;

			$pedido = new Pedido();
			$pedidos = $pedido->getAll();

			require_once 'views/pedido/mis_pedidos.php';
		}

		public function estado()
		{
			Utils::isAdmin();
			
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$estado = isset($_POST['estado'])? trim($_POST['estado']) : false;
				if( empty(Utils::showStatus($estado)))
				{
					$estado = false;
				}
				$pedido_id = isset($_POST['pedido_id'])? $_POST['pedido_id'] : false;			
				$pedido_id = filter_var($pedido_id,FILTER_VALIDATE_INT,array('min_range'=>1));

				if($estado && $pedido_id)
				{
					$pedido = new Pedido();
					$pedido->setId($pedido_id);
					$pedido->setEstado($estado);					
					$save = $pedido->edit();
					header('Location:'.base_url.'Pedido/detalle&id='.$pedido_id);
				}
				else
				{
					header('Location:'.base_url);
				}
			}
			else
			{
				header('Location:'.base_url);
			}
		}

	}