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
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">
		<script src="js/myScript.js"></script>

		<title>Registrazione</title>
		
	</head>
	
	<body>

		<a href="login.php" style="left:12px;right:auto;"> <i class="fa-solid fa-caret-left"></i> </a>
		<a href="index.html"> <i class="fa-solid fa-house"></i> </a>
	
		<div class="cont-data cont-signup">
			<form id="registraForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <fieldset>

				<div class="cont-title">
                    <img src="img/logo.png" alt="logo">
					<h1> Registrazione </h1>
                </div>

				<p> Completa tutti i campi </p>

				<div id="signup">
					<div class="cont-inserisci">
						<label> Matricola: </label>
						<?php
							include "connessione.php";
							$sql = "SELECT MAX(ID_persona) AS id FROM Persona";
							$result = $conn -> query($sql);
							$row = $result -> fetch_assoc();
							$id = $row["id"] + 1;
							echo "<input type=\"number\" class=\"inserisci in_data\" name=\"ID_persona\" value='" .$id. "' readonly>";
							$result -> free();
							$conn -> close();
						?>
					</div>
					
					<div class="cont-inserisci">
						<label> Nome: </label>
						<input type="text" class="inserisci in_data" name="nome" required>
					</div>

					<div class="cont-inserisci">
						<label> Cognome: </label>
						<input type="text" class="inserisci in_data" name="cognome" required>
					</div>

					<div class="cont-inserisci">
						<label> Data di Nascita: </label>
						<input type="date" class="inserisci in_data" name="dataN" required>
					</div>

					<div id="caselle">
						<div>
							<input type="checkbox" id="M" name="sesso" value="M" onclick="check(this)">
							<label for="M"> Maschio </label> <i class="fa-solid fa-mars" style="color: blue;"></i>
						</div>
						
						<div>
							<input type="checkbox" id="F" name="sesso" value="F" onclick="check(this)">
							<label for="F"> Femmina </label> <i class="fa-solid fa-venus" style="color: magenta;"></i>
						</div>
					</div>

					<select id="type_person" onchange="select_control()" class="inserisci in_data select" name="tipo_pers" required>
						<option value=""> Seleziona </option>
						<option value="docente"> Docente </option>
						<option value="studente"> Studente </option>
					</select>

					<div class="cont-inserisci in_classe">
						<label> Classe: </label> 
						
						<select class="inserisci in_data select" name="anno">
							<option value="1"> 1 </option>
							<option value="2"> 2 </option>
							<option value="3"> 3 </option>
							<option value="4"> 4 </option>
							<option value="5"> 5 </option>
						</select>

						<input type="text" placeholder="Sezione" class="inserisci in_data" id="classe_sez" name="sezione" required>
					</div>
				</div>

				<hr>

				<div class="cont-inserisci">
					<i class="fa-solid fa-circle-user"></i>
					<?php
						$email = "ciao" .$id. "@scuola.it";
						echo "<input type=\"email\" placeholder=\"Username\" class=\"inserisci\" name=\"email\" value='" .$email. "' readonly>";
					?>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock" onclick="icon_change()"></i>
					<input type="password" placeholder="Password" class="inserisci" id="pwd" name="pwd" maxlength="100" required>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock2" onclick="icon_change2()"></i>
					<input type="password" placeholder="Conferma Password" class="inserisci" id="conf_pwd" name="conf_pwd" maxlength="100" required>
				</div>
				
				<div class="cont-button-signup">
					<input type="reset" value="Cancella" class="bottone cancella">
					<input type="submit" value="Conferma" class="bottone" name="invio">
				</div>

			</fieldset> </form>

			<?php
				if(isset($_POST['invio'])) {
					include 'connessione.php' ;

					$nome = $_POST["nome"];
					$cognome = $_POST["cognome"]; 
					$dataNascita = $_POST["dataN"];
					$sesso = $_POST["sesso"];
					$tipo = $_POST["tipo_pers"];
					
					$pw = $_POST["pwd"];
					$cpw = $_POST["conf_pwd"];
					
					// ID_classe non serve se autoincrement
					$anno = $_POST["anno"];
					$sezione = $_POST["sezione"];
					
					if($pw === $cpw){
						// DA RIVEDERE!!
						//include "connessione.php";
						try{
							$sql = "SELECT * FROM Classe WHERE anno = ".$anno." AND sezione = '".$sezione."'";
							$result = $conn -> query($sql);
						    $row = $result -> fetch_assoc();

							if(isset($row["ID_classe"])) {
								if($tipo == 'studente'){
									// INSERT PER STUDENTE
								} elseif($tipo == 'docente'){
									$sql1 = "INSERT INTO persona(nome, cognome, dataNascita, sesso, tipo) VALUES (".$nome."', '".$cognome."', '".$dataNascita."', '".$sesso."', 2,)";
								} else{
									echo "Non hai inserito il tipo della persona";
								}

								if ($conn->query($sql1) === TRUE){
									echo "Persona con codice " .$row["id"]. " registrata correttamente<br>";
								} else {
									echo "Errore nella registrazione";
								}

								$result -> free();
							}else{
								throw new Exception('');
							}
							}catch (Exception $e){
								// Da rivedere!!
								$sql = "INSERT INTO classe(ID_classe, anno, sezione) VALUES (".$ID_classe.",". $anno.",'".$sezione."')";
								$sql1 = "INSERT INTO persona(ID_persona, nome, cognome, dataNascita, sesso, tipo, ID_classe) VALUES (".$ID_persona.", '".$nome."', '".$cognome."', '".$dataNascita."', '".$sesso."', '2', '".$ID_classe."')";
								if ($conn->query($sql) === TRUE AND $conn->query($sql1) === TRUE) {
									echo "Persona con codice ".$ID_persona." registrata correttamente<br>";
								} else {
									echo "Errore nella registrazione";
								}
							}
					}else{
						echo "Le password inserite non corrispondono";
					}

					$conn -> close();
				} 
			?> 
		</div>

	</body>
</html>