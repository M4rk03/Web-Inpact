<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="img/logo.png">
		<link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/persona.css">
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">
		<script src="js/myScript.js"></script>

		<title>Pagina studente</title>

	</head>
	
	<body>

        <header>
			<figure> <a href="index.html"> <img class="logo" src="img/logo.png" alt="logo Web Inpact"> </a> </figure>
			<div class="header-titolo"> <h1> PAGINA STUDENTE </h1> </div>
			<div class="header-account">
				<a href="login.php"> <i class="fa-solid fa-circle-user"></i>
					<p>Logout</p> </a>
			</div>
		</header>
		
        <main>
            <h2> Eleco dei badge assegnati a <strong style="font-family:Mont;font-size:26px;">
				<?php
					include "connessione.php";
					session_start();
					$sql = "SELECT p.cognome, p.nome FROM persona p JOIN account a ON p.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "';";
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
					
					$sql1 = "SELECT DISTINCT m.nome as materia, m.ID_materia as ID, p.nome, p.cognome FROM materia m JOIN insegna i ON m.ID_materia = i.ID_materia JOIN persona p ON i.ID_persona = p.ID_persona;";
					$result1 = $conn -> query($sql1);
					
					// Parte ripetuta x la quantita' delle materie
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
							$color_name = 'sistemi';
						}

						echo "<div class='texture mater-inseg " .$color_name. "'> \n";
						echo "<p>" .$materia. "</p> \n";
						echo "<small>" .$nome_prof. "</small> \n </div> \n";
						echo "<div class='texture cont-materie sez-badge'> \n";

						try{
							$sql2 = "SELECT b.nome, b.livello, av.dataB FROM badge b JOIN assegna_visualizza av ON (b.codBadge = av.codBadge) AND (b.livello = av.livello) JOIN account a ON av.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "' AND b.materia = " .$row1["ID"]. ";";
							$result2 = $conn -> query($sql2);
							
							// Parte ripetuta x la quantita' delle materie insegnate
							while($row2 = $result2->fetch_assoc()){
								$badge = $row2["nome"]."".$row2["livello"];
								echo "<figure class='cont-badge' name='" .$badge. "' onclick='zoom_badge(this)'> \n";
								echo "<img src='img/badge/" .$badge. ".png' alt=" .$badge. "> \n </figure> \n";
							}
						}catch(Exception $e){
							echo "<p> Non è stato trovato nessun badge </p>";
						}

						echo "</div> \n </div> \n";
					}
					$result1 -> free();
					$result2 -> free();
					$conn -> close();
				?>

			</div>
        </main>
		
		<footer>
			<figure> <img src="img/scritta.png" alt="scritta Web Imapact" style="width:180px;"> </figure>

			<div id="cont-social">
				<p>ISISS "M.O. Luciano Dal Cero"</p>
				<class class="social">
					<a href="https://web.whatsapp.com/"> <img src="img/whatsapp.png" alt="logo Whatsapp"> </a>
					<a href="https://mail.google.com/"> <img src="img/email.png" alt="logo Email"> </a>
					<a href="https://it-it.facebook.com/"> <img src="img/facebook.png" alt="logo Facebook"> </a>
					<a href="https://www.instagram.com/accounts/login/"> <img src="img/instagram.png" alt="logo Instagram"> </a>
				</class>
				<small>Copyright &copy 2023</small>
			</div>

			<figure style="justify-content:right;"> <img src="img/dalcero.png" alt="logo DalCero" style="width:100px;"> </figure>
		</footer>

	</body>
</html>