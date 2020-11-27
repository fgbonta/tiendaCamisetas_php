<h1>Gestión de productos</h1>

<?php if(isset($_SESSION['register'])): ?>
	
<?php if($_SESSION['register']=='complete'): ?>
<strong class="alert_green">Registro completado</strong>
<?php endif; ?>

<?php if($_SESSION['register']=='failed'): ?>
<strong class="alert_red">Registro fallido</strong>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>

<?php endif; ?>

<a href="<?=base_url?>Producto/crear" class="button button-small">
	Crear producto
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
	</tr>
<?php while($pro = $productos->fetch_object()): ?>
	<tr>
		<td><?=$pro->id?></td>
		<td><?=$pro->nombre?></td>
		<td><?=$pro->precio?></td>
		<td><?=$pro->stock?></td>
	</tr>
<?php endwhile; ?>
</table> 