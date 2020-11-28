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

	}