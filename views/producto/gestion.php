<h1>Gestión de productos</h1>

<a href="<?=base_url?>Producto/crear" class="button button-small">
	Crear producto
</a>

<?php if(isset($_SESSION['register'])): ?>
	<?php if(isset($_SESSION['register']['create'])): ?>
		<?php if($_SESSION['register']['create']=='complete'): ?>
		<strong class="alert_green">El producto se ha creado correctamente</strong>
		<?php endif; ?>

		<?php if($_SESSION['register']['create']=='failed'): ?>
		<strong class="alert_red">El producto NO se ha creado correctamente</strong>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(isset($_SESSION['register']['edit'])): ?>
		<?php if($_SESSION['register']['edit']=='complete'): ?>
		<strong class="alert_green">El producto se ha modificado correctamente</strong>
		<?php endif; ?>

		<?php if($_SESSION['register']['edit']=='failed'): ?>
		<strong class="alert_red">El producto NO se ha modificado correctamente</strong>
		<?php endif; ?>
	<?php endif; ?>
	<?php Utils::deleteSession('register'); ?>
<?php endif; ?>

<?php if(isset($_SESSION['delete'])): ?>
	
	<?php if($_SESSION['delete']=='complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
	<?php endif; ?>

	<?php if($_SESSION['delete']=='failed'): ?>
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
	<?php endif; ?>

	<?php Utils::deleteSession('delete'); ?>

<?php endif; ?>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		<th>ACCIONES</th>
	</tr>
<?php while($pro = $productos->fetch_object()): ?>
	<tr>
		<td><?=$pro->id?></td>
		<td><?=$pro->nombre?></td>
		<td><?=$pro->precio?></td>
		<td><?=$pro->stock?></td>
		<td>
			<a href="<?=base_url?>Producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
			<a href="<?=base_url?>Producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>			
		</td>
	</tr>
<?php endwhile; ?>
</table> 