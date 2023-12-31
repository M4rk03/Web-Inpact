<?php require_once('../init.php'); ?>

<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="./media/img/logo.webp">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./media/fontawesome-icon/css/all.css">

		<title> WebInpact - Home </title>
		
	</head>
	
	<body>
		<!-- HEADER -->
		<?php require_once('./components/_header.php') ?>

		<main id="main">
			<div id="info">
				<h3 class="titolo">CHI SIAMO</h3>
				<p>
					Web Inpact è una azienda fondata nel 2022 come software house indipendente con l'obbiettivo di realizzare prodotti innovativi legati al web. <br><br>
					Questa applicazione è nata dalle richieste di un docente il quale ci ha affidato un compito molto importante : creare un sito web che potesse dare la possibilità a degli studenti di ricevere delle ricompense, in forma di badge, in base alle loro competenze; e ai professori di poterli assegnare ai rispettivi studenti. <br><br>
					I badge creati sono relativi all'ambito informatico ma in futuro si pensava di estendeli alle altre materie inserendo gli argomenti studiati come Badge.
					<br><br>
					Il nostro team è composto da 6 elementi di grande spessore: <br>
					• Il Project Manager e abile programmatore Front End: Marco Ferrarese <i class="fa-solid fa-computer icon-margin"></i> <br>
					• L'esperto creatore di pagine web Back End: Guerra Sebastiano <i class="fa-solid fa-server icon-margin"></i> <br>
					• Il rinomato Grafico nonchè creatore del design del sito: Matteo Scandolara <i class="fa-solid fa-compass-drafting icon-margin"></i> <br>
					• Il sempre al lavoro e diligente gestore del database: Diego Milli <i class="fa-solid fa-database icon-margin"></i> <br>
					• Il supporto del gruppo e tuttofare: Diego Girardi <i class="fa-solid fa-screwdriver-wrench icon-margin"></i> <br>
					• Ed infine il nostro social media manager: Gian Marco Cavallaro <i class="fa-solid fa-icons icon-margin"></i> 
				</p>
			</div>
			
			<div id="cont-generic">

				<div class="cont-badge">
					<div class="livelli"> 
						<img class="imgB" src="./media/img/badge_webp/C1.webp" alt="C base">
						<p> LIVELLO <br> BASE</p>
					</div>
					
					<div class="livelli">
						<img class="imgB" src="./media/img/badge_webp/C2.webp" alt="C intermedio">
						<p> LIVELLO <br> INTERMEDIO </p>
					</div>
					
					<div class="livelli">
						<img class="imgB" src="./media/img/badge_webp/C3.webp" alt="C esperto">
						<p> LIVELLO <br> ESPERTO </p>
					</div>
				</div>
				
				<div class="cont-badge">
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Cisco1.webp" alt="Cisco esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Crittografia1.webp" alt="Crittografia esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Css1.webp" alt="Css esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Hardware1.webp" alt="Hardware esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Html1.webp" alt="Html esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Java1.webp" alt="Java esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Javascript1.webp" alt="Javascript esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Office1.webp" alt="Office esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Php1.webp" alt="Php esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Python1.webp" alt="Python esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Reti1.webp" alt="Reti esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Software1.webp" alt="Software esperto"> </div>
					<div class="badge"> <img class="imgB" src="./media/img/badge_webp/Sql1.webp" alt="Sql esperto"> </div>
				</div>

			</div>
		</main>
		
		<!-- FOOTER -->
		<?php require_once('./components/_footer.php') ?>

	</body>
</html>