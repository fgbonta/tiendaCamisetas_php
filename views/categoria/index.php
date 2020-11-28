<h1>Gestionar Categorias</h1>

<a href="<?=base_url?>Categoria/crear" class="button button-small">
	Crear categoria
</a>

<?php if(isset($_SESSION['register'])): ?>
	
<?php if($_SESSION['register']=='complete'): ?>
<strong class="alert_green">La categoria se ha creado correctamente</strong>
<?php endif; ?>

<?php if($_SESSION['register']=='failed'): ?>
<strong class="alert_red">La categoria NO se ha creado correctamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>

<?php endif; ?>

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
<?php endwhile; ?>
</table> 