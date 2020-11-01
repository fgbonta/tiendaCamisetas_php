<h1>Registrarse</h1>

<?php
	if(isset($_SESSION['register']) && $_SESSION['register']=="complete"):
?>	
		<strong class="alert_green">Registro completado</strong>	
<?php 
	elseif(isset($_SESSION['register']) && $_SESSION['register']=="failed"):
?>
		<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>


<form action="<?=base_url?>Usuario/save" method="post">

	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" pattern="[A-Za-Z]+" required>

	<label for="apellidos">Apelidos</label>
	<input type="text" name="apellidos" pattern="[A-Za-z]+" required>

	<label for="email">Email</label>
	<input type="email" name="email" required>

	<label for="password">Contraseña</label>
	<input type="password" name="password" required>

	<input type="submit" value="Registrarse">
	
</form>