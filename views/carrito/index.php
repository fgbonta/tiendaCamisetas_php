<h1>Carrito de la compra</h1>

<?php if($carrito && !empty($carrito)): ?>
	<table>
		<tr>
			<th>Imagen</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Disponibles</th>
			<th>Unidades</th>
			<th>Eliminar</th>
		</tr>

		<?php foreach($carrito as $clave => $valor): 
				$producto = $valor['producto'];				
		?>

			<tr>
				<td><img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito"></td>
				<td><a href="<?=base_url?>Producto/ver&id=<?=$valor['id_producto']?>"><?=$producto->nombre?></a></td>
				<td>$ <?=$valor['precio']?></td>
				<td><?=$producto->stock?></td>
				<td>					
					<?=$valor['unidades']?>
					<div class="updown-unidades">
						<a href="<?=base_url?>Carrito/up&index=<?=$clave?>" class="button">+</a>
						<a href="<?=base_url?>Carrito/down&index=<?=$clave?>" class="button">-</a>
					</div>					
				</td>
				<td>
					<a href="<?=base_url?>Carrito/delete&index=<?=$clave?>" class="button button-carrito button-red">Borrar</a>
				</td>
			</tr>		

		<?php endforeach; ?>

	</table>
	<br>
	<div class="delete-carrito">
		<a href="<?=base_url?>Carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a>
	</div>
	
	<div class="total-carrito">
		<h3>Precio total: $ <?=Utils::statsCarrito()['total']?></h3>
		<a href="<?=base_url?>Pedido/hacer" class="button button-pedido">Hacer pedido</a>
	</div>

<?php else: ?>
	<p>El carrito esta vacío.</p>
<?php endif; ?>
