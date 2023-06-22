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
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form"> <fieldset>

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
							echo "<input type='number' class='inserisci in_data' name='ID_persona' value='" .$id. "' readonly>";
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
						echo "<input type='email' placeholder='Username' class='inserisci' name='email' value='" .$email. "' readonly>";
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
					
					$email = $_POST["email"];
					$pw = $_POST["pwd"];
					$cpw = $_POST["conf_pwd"];
					
					$anno = $_POST["anno"];
					$sezione = $_POST["sezione"];
					
					if($pw === $cpw){

						if (isset($tipo)) {

							try {
								$sql = "INSERT INTO persona(nome, cognome, dataNascita, sesso, tipo) VALUES ('".$nome."', '".$cognome."', '".$dataNascita."', '".$sesso."', ".$tipo.")";

								if ($tipo == 'studente'){
									// INSERT per studente
									$sql1 = "SELECT ID_classe FROM classe WHERE anno = " .$anno. " AND sezione = '" .$sezione.  "';";
									$result = $conn -> query($sql1);
									$row = $result -> fetch_assoc();
		
									if (isset($row["ID_classe"])) {
										// Se esiste la classe
		
									} else{
										// Se non esiste la classe
										$sql2 = "INSERT INTO classe(anno, sezione) VALUES (".$anno.", '".$sezione."')";
										$sql1 = "SELECT ID_classe FROM classe WHERE anno = " .$anno. " AND sezione = '" .$sezione.  "';";
										$result = $conn -> query($sql1);
										$row = $result -> fetch_assoc();
									}
		
									$sql3 = "INSERT INTO studente(ID_studente, ID_classe) VALUES (".$id.", '".$row["ID_classe"]."')";
		
								} else if ($tipo == 'docente'){
									// INSERT per studente
									// controllo materia !!
									// insert per insegna !!
								}

								$sql4 = "INSERT INTO account(nomeUtente, password, ID_persona) VALUES ('".$email."', '".$pw."', ".$id.")";

								if ($conn->query($sql4) === TRUE){
									echo "Persona con username " .$email. " registrata correttamente <br>";
								} else {
									echo "Errore nella registrazione <br> Riprova";
								}

								$result -> free();

							} catch (Exception $e) {
								echo "Qualcosa è andato storto <br>";
								echo $e;
							}

						} else{
							echo "Non hai inserito il tipo della persona";
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