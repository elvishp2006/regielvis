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
					Faltam apenas <strong>60 dias</strong>
				</div>

				<a data-scroll href="#confirmar" title="Confirmar Presença" class="btn">Confirmar presença</a>
			</div>
		</div>
	</header>

	<section class="section container">
		<h2 class="section-title">
			Lorem ipsum dolor sit amet.
		</h2>

		<div class="excerpt">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis expedita iste earum laudantium, harum atque dolorem autem esse dolorum similique aspernatur consequuntur excepturi quasi praesentium reprehenderit cupiditate id necessitatibus, ut.
			</p>

			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, mollitia!
			</p>
		</div>
	</section>

	<section id="galeria" class="section container">
		<h2 class="section-title">
			Galeria de Fotos
		</h2>

		<div id="gallery" class="gallery list list-small-col-2 list-medium-col-4 list-large-col-4">		
            <?php for( $i = 1; $i <= 12; $i++ ) { ?>
            <a href="assets/images/gallery/<?php echo $i ?>.jpg" title="" class="item">
                <img src="assets/images/gallery/t<?php echo $i ?>.png" alt="">					
            </a>
            <?php }; ?>
		</div>
	</section>

	<section id="padrinhos" class="section container section-godparents">
		<header class="section-header">
			<h2 class="section-title">
				Padrinhos
			</h2>
		</header>

        <?php for( $i = 0; $i < 13; $i++ ) { ?>
		<div class="godparents">
			<figure class="thumb">
				<img src="http://placehold.it/130x80" alt="">
			</figure>

			<figure class="thumb">
				<img src="http://placehold.it/130x80" alt="">
			</figure>

			<h3 class="names">
				Lorem ipsum dolor.
			</h3>
		</div>
        <?php }; ?>
	</section>

	<div class="section container section-box">
		<section id="presentes" class="box">
			<h2 class="section-title">
				Lista de Presentes
			</h2>

			<div class="list-stores">
				<a href="" title="" class="store">
					<figure class="thumb">
						<img src="assets/images/magazine-luiza.png" alt="Magazine Luiza Loja Virtual">
					</figure>

					<div>
						Ir para loja virtual
					</div>
				</a>

				<a href="" title="" class="store">
					<figure class="thumb">
						<img src="assets/images/pernambucanas.png" alt="Pernambucanas Loja Fisica">
					</figure>

					<div>
						Ir para loja virtual
					</div>

                    <div class="info">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, voluptate!
                    </div>
				</a>				
			</div>
		</section>

		<section id="confirmar" class="box">
			<h2 class="section-title">
				Confirmar Presença
			</h2>

            <div class="text">
                Lorem ipsum dolor sit amet.
            </div>

			<form action="">
				<ul>
					<li>
						<input type="text" placeholder="Nome">
					</li>

					<li>
						<input type="text" placeholder="Quantidade de pessoas">
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
                        <img src="http://placehold.it/370x130" alt="">
                    </figure>

                    <div class="excerpt">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, maiores.
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, maiores.
                        </p>                    
                    </div>
                </div>
            </div>

            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d30206.665361565098!2d-41.96316815!3d-18.8500843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1494679271351" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>    
</div>

<script src="jquery.js"></script>
<script src="smooth-scroll.js"></script>
<script src="lightgallery.js"></script>
<script>
    smoothScroll.init({
        offset: 80,
    });

    $( ".gallery" ).lightGallery(); 
</script>	

</body>
</html>
