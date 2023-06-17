<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="img/logo.png">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="fontawesome-icon/css/all.css">
		<script src="js/myScript.js"></script>

		<title>Login</title>
		
	</head>
	
	<body onload="controllo()">

		<a href="index.html"> <i class="fa-solid fa-house"></i> </a>
	
		<div class="cont-data">
			<form action="" method="post"> <fieldset>

				<div class="cont-title">
                    <img src="img/logo.png" alt="logo">
					<h1> Esegui l'Accesso </h1>
                </div>

				<p> Inserisci qui i tuoi dati </p>

				<div class="cont-inserisci">
					<i class="fa-solid fa-circle-user"></i>
					<input type="number" placeholder="Username" class="inserisci" name="codice" maxlength="5" required>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock" onclick="icon_change()"></i>
					<input type="password" placeholder="Password" class="inserisci" id="pwd" name="password" maxlength="100" required>
				</div>

				<div id="caselle">
					<div>
						<input type="checkbox" id="prof" name="docente" onclick="check(this)">
						<label for="prof"> Docente </label>
					</div>
					
					<div>
						<input type="checkbox" id="stu" name="studente" onclick="check(this)">
						<label for="stu"> Studente </label>
					</div>
				</div>

				<?php
					if(isset($_POST["accedi"])){
						session_start();
						$_SESSION["nomeUtente"] = $_POST["codice"];
						$_SESSION["password"] = $_POST["password"];

						try{
							include "connessione.php";
							$sql = "SELECT nomeUtente, password, Account.tipo AS tipo from Account join Persona on Persona.ID_persona = Account.nomeUtente WHERE Account.nomeUtente = ".$_POST["codice"]." AND Account.password ='".$_POST["password"]."'";
							$result = $conn -> query($sql);
							$row = $result -> fetch_assoc();
							if((isset($row["nomeUtente"]) AND isset($row["password"])) AND ($row["nomeUtente"] === $_SESSION["nomeUtente"] AND $row["password"] === $_SESSION["password"])){
								$_SESSION['tipo'] = $row["tipo"];
								if(isset($_POST["studente"]) AND $_SESSION["tipo"] == 1){
								$_SESSION['studente'] = $_POST["studente"];
								header('location:studente.php');
								echo "<script type ='text/javascript'>";
								echo "location.href ='studente.php';";
								echo "</script>";
							} else if(isset($_POST["docente"])AND $_SESSION["tipo"] == 2){
								$_SESSION['docente'] = $_POST["docente"];
								header('location:docente.php');
								echo "<script type ='text/javascript'>";
								echo "location.href ='docente.php';";
								echo "</script>";
							} else{
								throw new Exception("Tipo dell'account errato");
							}
							} else{
								throw new Exception("Errore nell'inserimento dei dati");
							}
						}catch (Exception $e){
							echo $e -> getMessage();
						}

						$result -> free();
						$conn -> close();
					}
				?>
				
				<div class="cont-button">
                    <input type="submit" onclick="login();" value="Accedi" name="accedi" id="accedi">

					<button id="bottone-pwd" onclick="password();"> Password <br> Dimenticata? </button>
					<a href="registra.php" id="registrati"> Registrati </a>
				</div>

			</fieldset> </form>
		</div>

	</body>
</html>