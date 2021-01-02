<h1>Mis pedidos</h1>

<table>
	<tr>
		<th>ID</th>
		<th>Coste</th>
		<th>Fecha</th>		
	</tr>

	<?php while( $ped = $pedidos->fetch_object() ): ?>

		<tr>
			<td><a href="<?=base_url?>Pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a></td>
			<td>$ <?=$ped->coste?></td>
            <td><?=$ped->fecha?></td>
		</tr>		

	<?php endwhile; ?>

</table>