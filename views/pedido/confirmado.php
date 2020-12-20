<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu pedido se ha confirmado</h1>
<p>
	Tu pedido ha sido guardado con exito, una vez que realices la transferencia
	bancaria a la cuenta EDCRFVTGBYHNUJM con el coste del pedido, será procesado y enviado.
</p>
<br>

<?php if($pedido): ?>
<h3>Datos del pedido</h3>
Número del pedido: <?=$pedido->id?><br>
Total a pagar: <?=$pedido->coste?><br>

<table>
<caption>Productos</caption>
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

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
	<h1>Tu pedido NO se ha podido procesar</h1>
<?php endif; ?>