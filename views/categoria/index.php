<h1>Gestionar Categorias</h1>

<?php if(isset($_SESSION['register'])): ?>	
	
	<?php if($_SESSION['register']=='complete'): ?>	

		<strong class="alert_green">Registro completado</strong>	
	
	<?php elseif($_SESSION['register']=='failed'): ?>
		
		<strong class="alert_red">Registro fallido</strong>

	<?php endif; ?>		

	<?php Utils::deleteSession('register'); ?>

<?php endif; ?>

<a href="<?=base_url?>Categoria/crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
	</tr>
<?php while($cat = $categorias->fetch_object()): ?>	
	<tr>
		<td><?=$cat->id?></td>
		<td><?=$cat->nombre?></td>
	</tr>
<?php endWhile; ?>
</table>

 