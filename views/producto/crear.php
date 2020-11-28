<?php if(isset($dataPro) && is_object($dataPro)): ?>
	<h1>Editar producto <?=$dataPro->nombre?></h1>	
<?php else: ?>
	<h1>Crear nuevo producto</h1>	
<?php endif; ?>

<div class="form_container">
	<form action="<?=base_url?>Producto/save" method="post" enctype="multipart/form-data">

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($dataPro) && is_object($dataPro)?$dataPro->nombre:''?>" required>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion" required><?=isset($dataPro) && is_object($dataPro)?$dataPro->descripcion:''?></textarea>

		<label for="precio">Precio</label>
		<input type="number" name="precio" min="0" step="0.01" value="<?=isset($dataPro) && is_object($dataPro)?$dataPro->precio:''?>" required>

		<label for="stock">Stock</label>
		<input type="number" name="stock" min="0" value="<?=isset($dataPro) && is_object($dataPro)?$dataPro->stock:''?>" required>

		<?php $categorias = Utils::showCategorias(); ?>
		<label for="categoria">Categoria</label>
		<select name="categoria" required>
			<?php while($cat = $categorias->fetch_object()): ?>
				<option value="<?=$cat->id?>" <?=isset($dataPro) && is_object($dataPro) && $cat->id == $dataPro->categoria_id?'selected':''?>>
					<?=$cat->nombre?>
				</option>
			<?php endwhile; ?>
		</select>

		<label for="image">Imagen</label>
		<?php if( isset($dataPro) && is_object($dataPro) && !empty($dataPro->imagen) ): ?>
			<img src="<?=base_url?>uploads/images/<?=$dataPro->imagen?>" class="thumb">
		<?php endif; ?>
		<input type="file" name="image">

		<?php if( isset($dataPro) && is_object($dataPro)): ?>
			<input type="hidden" name="id" value="<?=$dataPro->id?>">
		<?php endif; ?>	

		<input type="submit" value="Guardar">

	</form>
</div>