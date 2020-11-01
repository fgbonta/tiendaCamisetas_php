<h1>Registrarse</h1>

<?php
	if(isset($_SESSION['register']) && $_SESSION['register']=="complete"):
	
		echo "<strong>Registro completado</strong>";	
	else:	
		echo "<strong>Registro fallido</strong>";
	endif;
?>

<form action="<?=base_url?>Usuario/save" method="post">

	<label for="nombre">Nombre</label>
	<input type="text" name="nombre">

	<label for="apellidos">Apelidos</label>
	<input type="text" name="apellidos">

	<label for="email">Email</label>
	<input type="email" name="email">

	<label for="password">Contraseña</label>
	<input type="password" name="password">

	<input type="submit" value="Registrarse">
	
</form>