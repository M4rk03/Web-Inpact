<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="img/logo.png">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/account.css">
        <link rel="stylesheet" href="css/persona.css">
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">
		<script src="js/myScript.js"></script>

		<title>Registro di Classe</title>

	</head>
	
	<body>

        <header>
			<figure> <a href="index.html"> <img class="logo" src="img/logo.png" alt="logo Web Inpact"> </a> </figure>
			<div class="header-titolo"> <h1> REGISTRO ALUNNI </h1> </div>
			<div class="header-account">
				<a href="login.php"> <i class="fa-solid fa-circle-user"></i>
					<p>Logout</p> </a>
			</div>
		</header>
		
        <main>
			<div class="elenco" style="justify-content:space-evenly;">
				<a href="docente.php" class="back"> <i class="fa-solid fa-caret-left"></i> </a>
				
				<h2> Registro della classe <strong class="subtitle">
					<?php
						session_start();
						if (isset($_POST["anno"])) {
							$_SESSION['anno'] = $_POST["anno"];
						}
						if (isset($_POST["sezione"])) {
							$_SESSION['sezione'] = $_POST["sezione"];
						}
						if (isset($_POST["materia"])) {
							$_SESSION['materia'] = $_POST["materia"];
						}
						
						echo strtoupper($_SESSION['anno'])."".strtoupper($_SESSION['sezione']);
					?> </strong>
				</h2>

				<h2> Materia: <strong class="subtitle">
					<?php
						echo strtoupper($_SESSION['materia']);
					?> </strong>
				</h2>
			</div>
			
			<div id="registro">

                <div class="tabella">
                    <p class="texture tab-titoli"> Alunni </p>
                    <p class="texture tab-titoli"> Badge assegnati </p>
                </div>

				<?php
					include "connessione.php";
					
					$sql = "SELECT p.nome, p.cognome, p.dataNascita, p.ID_persona as ID FROM persona p JOIN studente s ON p.ID_persona = s.ID_studente JOIN classe c ON s.ID_classe = c.ID_classe WHERE c.anno = " .$_SESSION["anno"]. " AND c.sezione = '" .$_SESSION["sezione"]. "';";
					$result = $conn -> query($sql);
					
					// Parte ripetuta x la quantita' degli studenti
					$num = 0;
					try{
						while($row = $result->fetch_assoc()){
							$num++;
							echo "<div class='tabella cont-elenco'> \n";
							echo "<div class='elenco list-alunno'> \n";
							echo "<small>" .$num. "</small> \n";
						
							$alunno = strtoupper($row["nome"])." ".strtoupper($row["cognome"]);
							echo "<p>" .$alunno. "</p> \n";
							echo "<p>" .$row["dataNascita"]. "</p> \n </div> \n";
							echo "<div class='elenco'> \n";
						
							try{
								$sql1 = "SELECT b.nome, b.livello, av.dataB FROM badge b JOIN assegna_visualizza av ON (b.codBadge = av.codBadge) AND (b.livello = av.livello) JOIN materia m ON b.materia = m.ID_materia WHERE av.ID_persona = " .$row["ID"]. " AND m.nome = '" .$_SESSION["materia"]. "';";
								$result1 = $conn -> query($sql1);
								
								// Parte ripetuta x la quantita' dei badge assegnati
								while($row1 = $result1->fetch_assoc()){
									$badge = $row1["nome"]."".$row1["livello"];

									echo "<figure class='cont-badge cont-badge-el' onclick='modify_badge(this, ".$row["ID"].")'> \n";
									echo "<img src='img/badge/" .$badge. ".png' alt=" .$badge. "> \n </figure> \n";
								}

							}catch (Exception $e){
								echo "<p> Non è stato trovato nessun badge </p>";
							}

							echo "<figure class='cont-badge cont-badge-el' onclick='add_badge(".$row["ID"].")' style='margin-left: 10px;'> \n";
							echo "<img src='img/addB.png' alt='add badge'> \n </figure> \n";
							echo "</div> \n </div> \n";

							$result1 -> free();
						}
					}
					catch (Exception $e){
						echo "<p> Non è stato trovato nessun alunno </p>";
					}

					$result -> free();
					$conn -> close();
				?>

				<!-- POPUP -->
				<!-- Assegna badge -->
				<div id="add-badge" class="cont-popup">
					<!-- // Da rivedere l'action!! -->
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form form-badge">
							
						<h2>Assegna badge</h2>
				
						<div class="cont-inserisci">
							<label> Argomento: </label> 
							
							<select id="add-nomeB" class="inserisci in_data select" onchange="visual_img()" name="argomento" required>
								<option value=""> Seleziona </option>
								<?php
									include "connessione.php";
									
									$sql = "SELECT DISTINCT b.nome FROM badge b JOIN materia m ON b.materia = m.ID_materia WHERE m.nome = '" .$_SESSION["materia"]. "';";
									$result = $conn -> query($sql);
									
									// Parte ripetuta x la quantita' dei badge
									try{
										while($row = $result->fetch_assoc()){
											echo "<option value=" .$row["nome"]. ">" .$row["nome"]. "</option>";
										}
									}
									catch (Exception $e){
										echo "Errore";
									}
				
									$result -> free();
									$conn -> close();
								?>
							</select>
						</div>
			
						<div class="cont-inserisci">
							<label> Livello: </label> 
							
							<select id="add-livelloB" class="inserisci in_data select" onchange="visual_img()" name="livello" required>
								<option value=""> Seleziona </option>
								<?php
									include "connessione.php";
					
									$sql = "SELECT DISTINCT livello FROM badge;";
									$result = $conn -> query($sql);
									
									// Parte ripetuta x i livelli dei badge
									try{
										while($row = $result->fetch_assoc()){
											echo "<option value=" .$row["livello"]. ">" .$row["livello"]. "</option>";
										}
									}
									catch (Exception $e){
										echo "Errore";
									}
				
									$result -> free();
									$conn -> close();
								?>
							</select>
						</div>
			
						<div class="cont-inserisci">
							<label> Data: </label>
							<input type="date" class="inserisci in_data" name="dataB" required>
						</div>

						<div class="cont-inserisci">
							<label> Descrizione: </label>
							<textarea class="inserisci in_data" name="testo" rows="4" style="resize:none;height:auto;"></textarea>
						</div>
				
						<div class="cont-button-signup">
							<input type="reset" onclick="close_add()" value="Chiudi" class="bottone cancella">
							<input type="submit" value="Assegna" class="bottone" name="assegna">
						</div>

					</form>

					<!-- PHP nel div alerts --> 
				</div>

				<!-- Modifica badge -->
				<div id="modify-badge" class="cont-popup">
					<div class="cont-modifyB">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form form-badge">
								
							<h2>Modifica badge</h2>
						
							<div class="cont-inserisci">
								<label> Argomento: </label> 
								
								<select name="mod-nomeB" id="mod-nomeB" class="inserisci in_data select" onchange="visual_img()" name="nome" required>
									<option value=""> Seleziona </option>
									<?php
										include "connessione.php";
						
										$sql = "SELECT DISTINCT b.nome FROM badge b JOIN materia m ON b.materia = m.ID_materia WHERE m.nome = '" .$_SESSION["materia"]. "';";
										$result = $conn -> query($sql);
										
										
										// Parte ripetuta x la quantita' dei badge
										try{
											while($row = $result->fetch_assoc()){
												echo "<option value=" .$row["nome"]. ">" .$row["nome"]. "</option>";
											}
										}
										catch (Exception $e){
											echo "Errore";
										}
										
										if(!isset($_SESSION["nomeBadgeIniziale"])) {
											$_SESSION["nomeBadgeIniziale"]=$_POST["mod-nomeB"];
										}
										$result -> free();
										$conn -> close();
									?>
								</select>
							</div>
						
							<div class="cont-inserisci">
								<label> Livello: </label> 
								
								<select name="mod-livelloB" id="mod-livelloB" class="inserisci in_data select" onchange="visual_img()" name="livello" required>
									<option value=""> Seleziona </option>
									<?php
										include "connessione.php";
						
										$sql = "SELECT DISTINCT livello FROM badge;";
										$result = $conn -> query($sql);
										
										// Parte ripetuta x i livelli dei badge
										try{
											while($row = $result->fetch_assoc()){
												echo "<option value=" .$row["livello"]. ">" .$row["livello"]. "</option>";
											}
										}
										catch (Exception $e){
											echo "Errore";
										}
										
										if(!isset($_SESSION["livelloIniziale"])) {
											$_SESSION["livelloIniziale"]=$_POST["mod-livelloB"];
										}
					
										$result -> free();
										$conn -> close();
									?>
								</select>
							</div>
						
							<div class="cont-inserisci">
								<label> Data: </label>
								<?php
									include "connessione.php";
									
									// Come prendere i dati?!
									$sql = "SELECT av.codBadge, av.dataB FROM assegna_visualizza av JOIN badge b ON (av.codBadge = b.codBadge) AND (av.livello = b.livello) WHERE av.ID_persona = 1 AND b.nome = 'C' AND av.livello = 2;";
									$result = $conn -> query($sql);
									
									// Parte ripetuta x i livelli dei badge
									try{
										echo "<input type=\"date\" class=\"inserisci in_data\" value=\"2011-03-21\" name=\"dataB\" required>";
									}
									catch (Exception $e){
										echo "Errore";
									}
				
									$result -> free();
									$conn -> close();
								?>
							</div>
						
							<div class="cont-inserisci">
								<label> Descrizione: </label>
								<textarea class="inserisci in_data" name="testo" rows="4" style="resize:none;height:auto;">Sei stato molto bravo...</textarea>
							</div>
						
							<div class="cont-button-signup">
								<input type="button" onclick="close_modify()" value="Chiudi" class="bottone cancella">
								<input type="submit" value="Modifica" class="bottone" name="modifica">
							</div>
						
						</form>

						<?php
							if(isset($_POST['modifica'])) {
								include 'connessione.php' ;
								
								$id_pers = $_POST["ID_persona"];
								
								try{
									$sql1 = "SELECT codBadge AS codIniziale FROM badge WHERE nome='" .$_SESSION["nomeBadgeIniziale"]. "' AND livello=" .$_SESSION["livelloIniziale"]. ";";
									$result1 = $conn -> query($sql1);
									$row1 = $result1 -> fetch_assoc();
									
									
									$sql2 = "SELECT codBadge FROM badge WHERE nome = '" .$_POST["mod-nomeB"]. "' AND livello = " .$_POST["mod-livelloB"]. ";";
									$result2 = $conn -> query($sql2);
									$row2 = $result2 -> fetch_assoc();
									
									$sql1 = "UPDATE assegna_visualizza SET codBadge=".
									
									$sql1 = "UPDATE assegna_visualizza SET codBadge=".$row2["codBadge"].", livello=".$_POST["mod-livelloB"].", data='".$_POST["dataB"]." WHERE ID_persona=".$id_pers." AND codBadge=".$row1["codIniziale"]." AND livello=".$_SESSION["livelloIniziale"]. ";";

									if ($conn->query($sql1) === TRUE){
										echo "<script>refreshPage();</script>";
									} else {
										echo "Errore nell'assegnazione del badge <br> Riprova \n";
									}
								} catch (Exception $e){
									echo "Errore inprevisto durante l'aggiornamento, riprovare";
								}

								$result1 -> free();
								$result2 -> free();
								$conn -> close();
							}
						?> 
					</div>
				</div>

				<!-- Popup di notifica -->
				<div id="alerts" class="cont-popup">
					<div class="cont-alerts">
						<p>Prova</p>

						<?php
							// PHP di Assegna badge
							if(isset($_POST['assegna'])) {
								include 'connessione.php' ;

								$nome = $_POST["argomento"];
								$livello = $_POST["livello"]; 
								$dataB = $_POST["dataB"];
								//$descrizione = $_POST["testo"];
								$id_pers = $_POST["ID_persona"];
								
								try{
									$sql = "SELECT codBadge FROM badge WHERE nome = '" .$nome. "' AND livello = " .$livello. ";";
									$result = $conn -> query($sql);
									$row = $result -> fetch_assoc();

									$sql1 = "INSERT INTO assegna_visualizza(ID_persona, codBadge, livello, dataB) VALUES (".$id_pers.", ".$row["codBadge"].", ".$livello.", '".$dataB."')";

									if ($conn->query($sql1) === TRUE){
										echo "<script>refreshPage();</script>";
									} else {
										echo "<script id='codice'> view_alert('Errore nell'assegnazione del badge <br> Riprova') </script> \n";
									}
								} catch (Exception $e){
									echo "Qualcosa è andato storto \n";
								}

								$result -> free();
								$conn -> close();
							}
						?>

						<input type="button" onclick="close_alert()" value="Chiudi" class="btn-close">
					</div>
				</div>

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