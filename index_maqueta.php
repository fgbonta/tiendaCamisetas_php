<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./assets/css/styles.css">
	<title>Tienda de Camisetas</title>
</head>
<body>

	<div id="container">

		<header id="header">
			<div id="logo">
				<img src="assets/img/CamisetaRojaTrans.png" alt="camiseta logo">
				<a href="index.php">Tienda de Camisetas</a>
			</div>
		</header>

		<nav id="menu">
			<ul>
				<li>
					<a href="">Inicio</a>
				</li>
				<li>
					<a href="">Categoria 1</a>
				</li>
				<li>
					<a href="">Categoria 2</a>
				</li>
				<li>
					<a href="">Categoria 3</a>
				</li>
				<li>
					<a href="">Categoria 4</a>
				</li>
				<li>
					<a href="">Categoria 5</a>
				</li>
			</ul>
		</nav>

		<div id="content">

			<aside id="lateral">

				<div id="login" class="block_aside">
					<h3>Entrar a la web</h3>
					<form action="" method="post">
						<label for="email">Email</label>
						<input type="email" name="email">
						<label for="password">Contrasena</label>
						<input type="password" name="password">

						<input type="submit" value="Enviar">
					</form>
					
					<ul>
						<li>
							<a href="">Mis pedidos</a>
						</li>
						<li>
							<a href="">Gestionar pedidos</a>
						</li>
						<li>
							<a href="">Gestionar categorias</a>
						</li>
					</ul>					

				</div>
				
			</aside>

			<div id="central">

				<h1>Productos destacados</h1>

				<div class="product">
					<img src="./assets/img/CamisetaRojaTrans.png">
					<h2>Camiseta roja Ancha</h2>
					<p>$900</p>
					<a href="" class="button">Comprar</a>
				</div>

				<div class="product">
					<img src="./assets/img/CamisetaRojaTrans.png">
					<h2>Camiseta roja Ancha</h2>
					<p>$900</p>
					<a href="" class="button">Comprar</a>
				</div>

				<div class="product">
					<img src="./assets/img/CamisetaRojaTrans.png">
					<h2>Camiseta roja Ancha</h2>
					<p>$900</p>
					<a href="" class="button">Comprar</a>
				</div>

			</div>

		</div>

		<footer id="footer">

			<p>Desarrollado por Fernando Bontá &copy; <?=Date('Y')?></p>

		</footer>

	</div>
		
</body>
</html>