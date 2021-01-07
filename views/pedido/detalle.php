<h1>Detalle del pedido</h1>
<?php if(isset($pedido)): ?>
    <h3>Dirección de envío</h3>
	Provincia: <?=$pedido->provincia?><br>
	Ciudad: <?=$pedido->localidad?><br>
    Dirección: <?=$pedido->direccion?><br><br>

	<h3>Datos del pedido</h3>
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