<?php

	ini_set('display_errors',1);

	session_start();

	require_once 'autoload.php';
	require_once 'config/db.php';
	require_once 'config/parameters.php';
	require_once 'helpers/utils.php';
	require_once 'views/layouts/header.php';
	require_once 'views/layouts/sidebar.php';

	function show_error()
	{
		$error = new ErrorController();
		$error->index();
	}

	if(isset($_GET['controller']))
	{
		$nombre_controlador = $_GET['controller'].'Controller';
	}
	elseif(!isset($_GET['controller']) && !isset($_GET['accion']))
	{
		$nombre_controlador = controller_default;
	} 
	else
	{		
		show_error();
		exit();
	}

	if(class_exists($nombre_controlador))
	{
		$controlador = new $nombre_controlador();

		if(isset($_GET['accion']) && method_exists($controlador, $_GET['accion']))
		{
			$action = $_GET['accion'];
			$controlador->$action();
		}
		elseif(!isset($_GET['controller']) && !isset($_GET['accion']))
		{
			$action = action_default;
			$controlador->$action();
		} 
		else
		{
			show_error();
		}
	}
	else
	{
		show_error();
	}

	require_once 'views/layouts/footer.php';