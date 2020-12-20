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
				
			}
			else
			{
				header('Location:'.base_url);
			}			

		}

	}