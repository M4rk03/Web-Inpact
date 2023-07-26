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

		<title> WebInpact - Registro docente </title>

	</head>
	
	<body>

        <header>
			<figure> <a href="index.html"> <img class="logo" src="img/logo.webp" alt="logo Web Inpact"> </a> </figure>
			<h1 class="titolo"> REGISTRO DOCENTE </h1>
			<div class="header-account menu">

				<div class="account-icon"> 
					<i class="fa-solid fa-circle-user"></i>
					<p>Account</p> 
				</div>

				<div class="account-options">
					<p onclick="deleteAccount()"> Elimina </p>
					<a href="login.php"> <p> <i class="fa-solid fa-xmark"></i> Esci </p> </a>
				</div>

			</div>
		</header>
		
        <main>
            <h2> Classi e materie del docente <strong class="sottotitolo">
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
                    <p class="texture tab-titoli"> Registro di classe </p>
                    <p class="texture tab-titoli"> Materie insegnate </p>
                </div>

				<?php
					include "connessione.php";
					
					$sql1 = "SELECT DISTINCT c.anno, c.sezione, c.ID_classe FROM classe c JOIN insegna i ON c.ID_classe = i.ID_classe INNER JOIN account a ON i.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "';";
					$result1 = $conn -> query($sql1);
					
					// Parte ripetuta x la quantita' delle classi
					while($row1 = $result1->fetch_assoc()){
						echo "<div class='tabella'> \n";
						echo "<div class='texture classe'> \n";

						$classe = strtoupper($row1["anno"])." ".strtoupper($row1["sezione"]);
						echo "<p>" .$classe. "</p> \n <i class='fa-solid fa-book-bookmark'></i> \n </div> \n";
						echo "<div class='texture cont-materie'> \n";

						try{
							$sql2 = "SELECT m.nome FROM materia m JOIN insegna i ON m.ID_materia = i.ID_materia JOIN account a ON i.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "' AND i.ID_classe = " .$row1["ID_classe"]. ";";
							$result2 = $conn -> query($sql2);
							
							// Parte ripetuta x la quantita' delle materie insegnate
							while($row2 = $result2->fetch_assoc()){

								// Passaggio dei dati per la pagina elenco
								echo "<form action='elenco.php' method='post'> \n";
								echo "<input name='anno' value='" .$row1["anno"]. "' hidden> <input name='sezione' value='" .$row1["sezione"]. "' hidden>";
								echo "<input name='materia' value='" .$row2["nome"]. "' hidden> \n <input name='nomeUtente' value='" .$_SESSION["nomeUtente"]. "' hidden> \n";


								$nome = strtoupper($row2["nome"]);
								echo "<button name='but-mat' class='materia'> \n";

								// Controllo colore materia
								$color_name = '';

								if($nome == 'TPSI'){
									$color_name = 'tpsi';
								} elseif($nome == 'SISTEMI E RETI'){
									$color_name = 'sistemi';
								} elseif($nome == 'INFORMATICA'){
									$color_name = 'informatica';
								} else{
									$color_name = 'altro';
								}

								echo "<span class='mat-color " .$color_name. "'></span> \n";
								echo "<p>" .$nome. "</p> \n </button> \n </form> \n";
							}
						}catch (Exception $e){
							echo "Non insegni in nessuna materia";
						}

						echo "</div> \n </div> \n";
					}
					$result1 -> free();
					$result2 -> free();
					$conn -> close();
				?>

			</div>
			
			<!-- Popup -->
			<div id="delete-acc" class="cont-popup">
				<div class="cont-alerts">
					<p> Sei sicuro di voler eliminare il tuo account definitivamente? </p>

					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
	
						<div class="grid-col-2" style="margin-top:20px;">
							<button onclick="close_delete()" class="btn-primary btn-secondary"> Annulla </button>
							<input type="submit" value="Elimina" class="btn-primary" name="elimina">
						</div>
					</form>

					<?php
						if (isset($_GET['elimina'])) {
							include 'connessione.php' ;

							try{
								$sql = "SELECT ID_persona FROM account WHERE nomeUtente = '" .$_SESSION["nomeUtente"]. "';";
								$result = $conn -> query($sql);
								$row = $result -> fetch_assoc();
								
								$sql1 = "DELETE FROM persona WHERE ID_persona = ".$row["ID_persona"].";";

								if ($conn->query($sql1) === TRUE){
									echo "L'account è stato eliminato correttamente";
									echo "<script> location.href = 'index.html' </script>";
								} else {
									echo "Errore nell'eliminazione dell'account <br> Riprova";
								}

								$result -> free();

							} catch (Exception $e){
								echo "Qualcosa è andato storto";
							}

							$conn -> close();
						}
					?>
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