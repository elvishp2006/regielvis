<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Regiane & Elvis</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<div id="wrapper">
	<header id="header">
		<nav class="navigation">
			<ul class="menu">
				<li><a data-scroll href="#confirmar" title="Confirmar Presença">Confirmar Presença</a></li>
				<li><a data-scroll href="#galeria" title="Galeria de Fotos">Galeria de Fotos</a></li>
				<li><a data-scroll href="#presentes" title="Lista de Presentes">Lista de Presentes</a></li>
				<li><a data-scroll href="#padrinhos" title="Padrinhos">Padrinhos</a></li>
				<li><a data-scroll href="#local" title="Local da Cerimônia">Local da Cerimônia</a></li>
			</ul>
		</nav>

		<div class="container">
			<div class="info">
				<h1 class="title">
					Regiane & Elvis
				</h1>

				<div class="missing">
					Faltam <strong id="countdown"></strong>
				</div>

				<a data-scroll href="#confirmar" title="Confirmar Presença" class="btn">Confirmar presença</a>
			</div>
		</div>
	</header>

	<section class="section container">
		<h2 class="section-title">
			Seja bem vindo!
		</h2>

		<div class="excerpt">
			<p>
				A contagem regressiva começa, o frio na barriga e toda a ansiedade do dia mais esperado de nossas vidas, o dia em que uniremos nossas almas e corpos para sempre, diante de Deus.
			</p>
		</div>
	</section>

	<section id="galeria" class="section container">
		<h2 class="section-title">
			Galeria de Fotos
		</h2>

		<div id="gallery" class="gallery list list-small-col-2 list-medium-col-4 list-large-col-4">
			<?php for( $i = 1; $i <= 12; $i++ ) : ?>
			<a href="assets/images/gallery/<?php echo $i ?>.jpg" title="" class="item">
				<img src="assets/images/gallery/t<?php echo $i ?>.png" alt="">
			</a>
			<?php endfor; ?>
		</div>
	</section>

	<section id="padrinhos" class="section container section-godparents">
		<header class="section-header">
			<h2 class="section-title">
				Padrinhos
			</h2>
		</header>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/accacio.jpg" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/natalia.jpg" alt="">
			</figure>

			<h3 class="names">
				Accácio e Natália
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Carlos e Sirlene
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Diogo e Jeniffer
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Douglas e Fabiana
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Ednaldo e Ednalva
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Erley e Carla
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Geraldo e Juliana
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Gracione e Debora
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/guilherme.jpg" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/pamela.jpg" alt="">
			</figure>

			<h3 class="names">
				Guilherme e Pâmela
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Joubert e Silvinha
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Kaique e Pricila
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/kayo.jpg" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Kayo e Barbara
			</h3>
		</div>

		<div class="godparents">
			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<figure class="thumb">
				<img src="assets/images/godparents/default.png" alt="">
			</figure>

			<h3 class="names">
				Nilton e Aneli
			</h3>
		</div>
	</section>

	<div class="section container section-box">
		<section id="presentes" class="box">
			<h2 class="section-title">
				Lista de Presentes
			</h2>

			<div class="list-stores">
				<a href="https://www.querodecasamento.com.br/lista-de-casamento/regiane-elvis" title="Lista Magazine Luiza" class="store" target="_blank" rel="noopener">
					<figure class="thumb">
						<img src="assets/images/magazine-luiza.png" alt="Magazine Luiza Loja Virtual">
					</figure>

					<div>
						Ir para loja virtual
					</div>
				</a>

				<div class="store">
					<figure class="thumb">
						<img src="assets/images/pernambucanas.png" alt="Pernambucanas Loja Fisica">
					</figure>

					<div>
						Endereço da loja física
					</div>

					<div class="info">
						R. Israel Pinheiro, 2824 - Centro, Gov. Valadares - MG, 35010-130
					</div>
				</div>
			</div>
		</section>

		<section id="confirmar" class="box">
			<h2 class="section-title">
				Confirmar Presença
			</h2>

			<div class="text">
				Lorem ipsum dolor sit amet.
			</div>

			<form id="rsvp" action="">
				<ul>
					<li>
						<input type="text" id="name" placeholder="Nome" required>
					</li>

					<li>
						<input type="text" id="quantity" placeholder="Quantidade de pessoas" required>
					</li>

					<li>
						<input type="submit" value="Confirmar Presença" class="btn">
					</li>
				</ul>
			</form>
		</section>
	</div>

	<section id="local" class="section">
		<h2 class="section-title">
			Local da cerimônia
		</h2>

		<div class="map">
			<div class="container">
				<div class="info">
					<figure class="thumb">
						<img src="assets/images/igreja-sao-jose.jpg" alt="">
					</figure>

					<div class="excerpt">
						<p>
							Endereço: R. João Lopes da Silva, 82 - Vl Bretas, Gov. Valadares - MG, 35032-210
						</p>
					</div>
				</div>
			</div>

			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15101.560626264503!2d-41.963154!3d-18.869765!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa52641d262abdfc9!2zSWdyZWphIFPDo28gSm9zw6kgT3BlcsOhcmlv!5e0!3m2!1spt-BR!2sbr!4v1494684196967" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</section>
</div>

<script src="jquery.js"></script>
<script src="smooth-scroll.js"></script>
<script src="lightgallery.js"></script>
<script src="jquery.countdown.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyC35MWSYb9DMNQPiHGhOtL8HSVEPWFyyq8",
		authDomain: "regielvis-dbb24.firebaseapp.com",
		databaseURL: "https://regielvis-dbb24.firebaseio.com",
		projectId: "regielvis-dbb24",
		storageBucket: "regielvis-dbb24.appspot.com",
		messagingSenderId: "1003278733605"
	};
	firebase.initializeApp(config);
</script>

<script src="main.js"></script>

</body>
</html>
