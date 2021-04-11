<h1>Detalle del pedido</h1>
<?php if(isset($pedido)): ?>
	<?php if(isset($_SESSION['admin'])): ?>
		<h3>Cambiar estado del pedido</h3>
		<form action="<?=base_url?>Pedido/estado" method="post">
			<select name="estado">
				<option value="confirm" <?=("confirm"==$pedido->estado)?'selected':''?>>Pendiente</option>
				<option value="preparation" <?=("preparation"==$pedido->estado)?'selected':''?>>En preparación</option>
				<option value="ready" <?=("ready"==$pedido->estado)?'selected':''?>>Preparado para enviar</option>
				<option value="sended" <?=("sended"==$pedido->estado)?'selected':''?>>Enviado</option>
			</select>
			<input type="hidden" name="pedido_id" value="<?=$pedido->id?>">
			<input type="submit" value="Cambia estado">
		</form>
		<br>
		<h3>Datos del usuario</h3>
		Nombre: <?=$usuario->nombre?><br>
		Apellido: <?=$usuario->apellidos?><br>
		email: <?=$usuario->email?><br><br>
	<?php endif; ?>

    <h3>Dirección de envío</h3>
	Provincia: <?=$pedido->provincia?><br>
	Ciudad: <?=$pedido->localidad?><br>
    Dirección: <?=$pedido->direccion?><br><br>

	<h3>Datos del pedido</h3>
	Estado: <?=Utils::showStatus($pedido->estado)?><br>
	Número del pedido: <?=$pedido->id?><br>
	Total a pagar: <?=$pedido->coste?><br>

	<table>
	Productos:
	<tr>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Unidades</th>
	</tr>
	<?php while( $pro = $productos->fetch_object() ): ?>
		<tr>
			<td><img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="img_carrito"></td>
			<td><?=$pro->nombre?></td>
			<td>$ <?=$pro->precio?></td>
			<td><?=$pro->unidades?></td>
		</tr>		
	<?php endwhile; ?>
	</table>	
<?php endif; ?>