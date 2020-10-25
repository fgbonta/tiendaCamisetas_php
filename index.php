<?php

	require_once 'autoload.php';

	require_once 'views/layouts/header.php';
	require_once 'views/layouts/sidebar.php';

	if(isset($_GET['controller']))
	{
		$nombre_controlador = $_GET['controller'].'Controller';
	} 
	else
	{
		echo 'La pagina no existe';
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
		else
		{
			echo 'La pagina no existe';
		}
	}
	else
	{
		echo 'La pagina no existe';
	}

	require_once 'views/layouts/footer.php';