
		<h1>Algunos de nuestros productos</h1>

		<?php while($pro = $productos->fetch_object()): ?>

		<div class="product">
			<a href="<?=base_url?>Producto/ver&id=<?=$pro->id?>">
				<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
				<h2><?=$pro->nombre?></h2>
			</a>
			<p>$<?=$pro->precio?></p>
			<a href="<?=base_url?>Carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
		</div>

		<?php endwhile; ?>

			