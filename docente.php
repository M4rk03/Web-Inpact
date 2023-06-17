<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="img/logo.png">
		<link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/docente.css">
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">

		<title>Registro docente</title>

	</head>
	
	<body>

        <header>
			<figure> <img src="img/logo.png" alt="logo Web Inpact"> </figure>
			<div class="header-titolo"> <h1> REGISTRO DOCENTE </h1> </div>
			<div class="header-account">
				<a href="login.php"> <i class="fa-solid fa-circle-user"></i>
					<p>Logout</p> </a>
			</div>
		</header>
		
        <main>
            <h2> Classi e materie del docente <strong style="font-family:Mont;font-size:26px;">
				<?php
					include "connessione.php";
					
					session_start();
					$sql = "SELECT cognome, nome FROM Persona WHERE ID_persona=".$_SESSION["nomeUtente"];
					$result = $conn -> query($sql);
					$row=$result -> fetch_assoc();
					print_r(" ".$row["cognome"]." ".$row["nome"]."\n");
					$result -> free();
					$conn -> close();
				?> </strong>
			</h2>
			
			<div id="registro">

                <div class="tabella">
                    <p class="texture tab-titoli"> Registro di classe </p>
                    <p class="texture tab-titoli"> Materie insegnate </p>
                </div>

				<?php
					include "connessione.php";
					
					$sql1 = "SELECT DISTINCT Classe.anno AS anno, Classe.sezione AS sezione, Classe.ID_classe AS ID FROM Persona JOIN  Insegna ON Persona.ID_persona = Insegna.ID_persona JOIN Classe ON Insegna.ID_classe = Classe.ID_Classe WHERE Persona.ID_persona =".$_SESSION["nomeUtente"];
					$result1 = $conn -> query($sql1);
					
					// Parte ripetuta x la quantita' delle classi
					while($row1 = $result1->fetch_assoc()){
						echo "<form action=\"elenco.php\" method=\"post\"> \n";
						echo "<div class=\"tabella\"> \n";
						echo "<div class=\"texture classe\"> \n";

						$classe = strtoupper($row1["anno"])." ".strtoupper($row1["sezione"]);
						echo "<p>" .$classe. "</p> \n <i class=\"fa-solid fa-book-bookmark\"></i> \n </div> \n";
						echo "<input name=\"anno\" value='" .$row1["anno"]. "' hidden> <input name=\"sezione\" value='" .$row1["sezione"]. "' hidden> <input name=\"ID\" value='" .$row1["ID"]. "' hidden>";
						echo "<div class=\"texture cont-materie\"> \n";

						try{
							$sql2 = "SELECT DISTINCT Materia.nome AS nome FROM Persona JOIN Insegna ON persona.ID_persona = insegna.ID_persona JOIN Materia ON insegna.ID_materia=materia.ID_materia JOIN classe ON classe.ID_classe=insegna.ID_classe WHERE Persona.ID_persona=".$_SESSION["nomeUtente"]." AND Classe.ID_classe=".$row1["ID"];
							$result2 = $conn -> query($sql2);
							
							// Parte ripetuta x la quantita' delle materie insegnate
							while($row2 = $result2->fetch_assoc()){
								$nome = strtoupper($row2["nome"]);
								echo "<button type=\"submit\" name=\"materia\" class=\"materia\"> \n";

								// Controllo colore materia
								$color_name = '';

								if($nome == 'TPSI'){
									$color_name = 'tpsi';
								} elseif($nome == 'SISTEMI E RETI'){
									$color_name = 'sistemi';
								} elseif($nome == 'INFORMATICA'){
									$color_name = 'informatica';
								} else{
									$color_name = 'sistemi';
								}

								echo "<span class=\"mat-color " .$color_name. "\"></span> \n";
								echo "<p>" .$nome. "</p> \n </button> \n";
							}
						}catch (Exception $e){
							echo "Non insegni in nessuna materia";
						}

						echo "</div> \n </div> \n </form>";
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