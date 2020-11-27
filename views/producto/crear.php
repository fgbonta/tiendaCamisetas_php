<h1>Crear nuevo producto</h1>
<div class="form_container">
	<form action="<?=base_url?>Producto/save" method="post" enctype="multipart/form-data">

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" required>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion" required></textarea>

		<label for="precio">Precio</label>
		<input type="number" name="precio" min="0" step="0.01" required>

		<label for="stock">Stock</label>
		<input type="number" name="stock" min="0" required>

		<?php $categorias = Utils::showCategorias(); ?>
		<label for="categoria">Categoria</label>
		<select name="categoria" required>
			<?php while($cat = $categorias->fetch_object()): ?>
				<option value="<?=$cat->id?>">
					<?=$cat->nombre?>
				</option>
			<?php endwhile; ?>
		</select>

		<label for="image">Imagen</label>
		<input type="file" name="image">

		<input type="submit" value="Guardar">

	</form>
</div>