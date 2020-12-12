<h1>Carrito de la compra</h1>
<table>
	<tr>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Unidades</th>
	</tr>

	<?php foreach($carrito as $clave => $valor): 
			$producto = $valor['producto'];				
	?>

		<tr>
			<td><img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito"></td>
			<td><a href="<?=base_url?>Producto/ver&id=<?=$valor['id_producto']?>"><?=$producto->nombre?></a></td>
			<td>$ <?=$valor['precio']?></td>
			<td><?=$valor['unidades']?></td>
		</tr>		

	<?php endforeach; ?>

</table>
<br>
<div class="total-carrito">
	<h3>Precio total: $ <?=Utils::statsCarrito()['total']?></h3>
	<a href="" class="button button-pedido">Hacer pedido</a>
</div>
