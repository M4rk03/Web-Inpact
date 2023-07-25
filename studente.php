<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="img/logo.webp">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">

		<title> WebInpact - Pagina studente </title>

	</head>
	
	<body>

        <header>
			<figure> <a href="index.html"> <img class="logo" src="img/logo.webp" alt="logo Web Inpact"> </a> </figure>
			<h1 class="titolo"> PAGINA STUDENTE </h1>
			<div class="header-account">
				<a href="login.php" class="account-icon"> <i class="fa-solid fa-circle-user"></i>
					<p>Logout</p> </a>
			</div>
		</header>
		
        <main>
            <h2> Eleco dei badge assegnati a <strong class="sottotitolo">
				<?php
					include "connessione.php";
					session_start();
					$sql = "SELECT p.cognome, p.nome, s.ID_classe FROM persona p JOIN account a ON p.ID_persona = a.ID_persona JOIN studente s ON a.ID_persona = s.ID_studente WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "';";
					$result = $conn -> query($sql);
					$row = $result -> fetch_assoc();
					print_r(" ".$row["cognome"]." ".$row["nome"]."\n");

					$result -> free();
					$conn -> close();
				?> </strong>
			</h2>
			
			<div id="registro">

                <div class="tabella">
                    <p class="texture tab-titoli"> Materie </p>
                    <p class="texture tab-titoli"> Badge assegnati </p>
                </div>
				
				<?php
					include "connessione.php";
					
					$sql1 = "SELECT DISTINCT m.nome as materia, m.ID_materia as ID, p.nome, p.cognome FROM materia m JOIN insegna i ON m.ID_materia = i.ID_materia JOIN persona p ON i.ID_persona = p.ID_persona WHERE i.ID_classe = " .$row["ID_classe"]. ";";
					$result1 = $conn -> query($sql1);
					
					// Parte ripetuta x la quantita' delle materie
					try {
						while($row1 = $result1->fetch_assoc()){
							$materia = $row1["materia"];
							$nome_prof = $row1["nome"]." ".$row1["cognome"];
	
							echo "<div class='tabella'> \n";
	
							// Controllo colore materia
							$color_name = '';
	
							if($materia == 'Tpsi'){
								$color_name = 'tpsi';
							} elseif($materia == 'Sistemi e Reti'){
								$color_name = 'sistemi';
							} elseif($materia == 'Informatica'){
								$color_name = 'informatica';
							} else{
								$color_name = 'altro';
							}
	
							echo "<div class='texture mater-inseg " .$color_name. "'> \n";
							echo "<p>" .$materia. "</p> \n";
							echo "<small>" .$nome_prof. "</small> \n </div> \n";
	
							try{
								$sql2 = "SELECT b.nome, b.livello, av.dataB, av.descrizione FROM badge b JOIN assegna_visualizza av ON (b.codBadge = av.codBadge) AND (b.livello = av.livello) JOIN account a ON av.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "' AND b.materia = " .$row1["ID"]. ";";
								$_result = $conn -> query($sql2);
								$_row = $_result->fetch_assoc();
								
								if (isset($_row['nome'])) {

									$result2 = $conn -> query($sql2);
									echo "<div class='texture cont-materie sez-badge'> \n";

									// Parte ripetuta x la quantita' dei badge
									while($row2 = $result2->fetch_assoc()){
										$badge = $row2["nome"]."".$row2["livello"];
										echo "<figure class='cont-badge-stud' name='" .$badge. "' onclick=\"zoom_badge('".$badge."', '".$row2["dataB"]."', '".$nome_prof."', '".$row1["materia"]."', '".$row2["descrizione"]."')\"> \n";
										echo "<img src='img/badge/" .$badge. ".png' alt=" .$badge. "> \n </figure> \n";
									}

									echo "</div> \n";
									$result2 -> free();

								} else {
									echo "<div class='texture'> Non hai badge assegnati </div> \n";
								}

							}catch(Exception $e){
								echo "Qualcosa è andato storto nella ricerca dei badge";
							}
	
							echo "</div> \n";

						}
					} catch (Exception $e) {
						echo "Qualcosa è andato storto nella ricerca delle materie";
					}

					$result1 -> free();
					$conn -> close();
				?>

			</div>

			<!-- Popup Badge -->
			<div id="visual-badge" class="cont-popup">
				<div class="cont-modifyB">

					<!-- Immagine Badge -->

					<div class="info-badge">
						<h2 class="titolo"> Badge </h2>
					
						<p class="info-badge-desc"> Assegnato il: <span id="data" class="descri"> <i class="fa-solid fa-calendar"></i> </span>
						Docente: <span id="prof" class="descri"> <i class="fa-solid fa-user-tie"></i> </span>
						Materia: <span id="mat" class="descri">  <i class="fa-solid fa-book"></i> </span> </p>
						<p> Descrizione: <br> <span id="desc" class="descri" style="justify-content:left;"> </span> </p>

						<input type="button" onclick="close_visual()" value="Chiudi" class="btn-primary btn-close">
					</div>

				</div>
			</div>
        </main>
		
		<footer>
			<figure> <img src="img/scritta.webp" alt="scritta Web Imapact" class="logo_scritta"> </figure>

			<div id="cont-social">
				<p class="titolo">ISISS "M.O. Luciano Dal Cero"</p>
				<div class="social">
					<a href="https://web.whatsapp.com/" target="_blank"> <i class="fa-brands fa-whatsapp"></i> </a>
					<a href="https://mail.google.com/" target="_blank"> <i class="fa-solid fa-envelope"></i> </a>
					<a href="https://it-it.facebook.com/" target="_blank"> <i class="fa-brands fa-facebook"></i> </a>
					<a href="https://www.instagram.com/accounts/login/" target="_blank"> <i class="fa-brands fa-instagram"></i> </a>
				</div>
				<small>Copyright &copy 2023</small>
			</div>

			<figure> <img src="img/dalcero.webp" alt="logo DalCero" class="logo"> </figure>
		</footer>

		<script src="js/myScript.js"></script>
	</body>
</html>