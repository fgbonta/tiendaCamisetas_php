<?php

	
	class Utils 
	{
		
		public static function deleteSession($name)
		{
			if(isset($_SESSION[$name]))
			{
				$_SESSION[$name] = null;
				unset($_SESSION[$name]);
			}

			return $name;
			
		}

		public static function isAdmin()
		{
			if(!isset($_SESSION['admin']))
			{
				header('Location:'.base_url);
			}
			else
			{
				return true;
			}
		}

		public static function showCategorias()
		{
			require_once 'models/Categoria.php';
			$categoria = new Categoria();			
			return $categoria->getAll();
		} 

		public static function createSession($name,$subname,$data)
		{
			if(!isset($_SESSION[$name]))
			{
				$_SESSION[$name] = array($subname=>$data);
				return true;				
			}

			return false;
			
		}

		public static function statsCarrito()
		{
			$stats = array(
				'count'=>0,
				'total'=>0
			);

			if(isset($_SESSION['carrito']))
			{
				$stats['count'] = count($_SESSION['carrito']);

				foreach ($_SESSION['carrito'] as $key => $value)
				{
					$stats['total'] += $value['precio']*$value['unidades'];
				}
			}

			return $stats;
		}

		public static function isIdentity()
		{
			if(!isset($_SESSION['identity']))
			{
				header('Location:'.base_url);
			}
			else
			{
				return true;
			}
		}
		
		public static function showStatus($status){
			$value = '';
			switch($status){
				case 'confirm': 
					$value = 'Pendiente';
					break;
				case 'preparation': 
					$value = 'En preparación';
					break;
				case 'ready': 
					$value = 'Preparado para enviar';
					break;
				case 'sended': 
					$value = 'Enviado';
					break;
			}
			return $value;
		}

	}