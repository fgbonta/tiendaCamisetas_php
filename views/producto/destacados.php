
		<h1>Algunos de nuestros productos</h1>

		<?php while($pro = $productos->fetch_object()): ?>

		<div class="product">
			<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
			<h2><?=$pro->nombre?></h2>
			<p>$<?=$pro->precio?></p>
			<a href="" class="button">Comprar</a>
		</div>

		<?php endwhile; ?>

			