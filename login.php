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

		<title>Login</title>
		
	</head>
	
	<body>

		<a href="index.html" class="btn-icon"> <i class="fa-solid fa-house fa-3x"></i> </a>
	
		<div class="cont-data">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form"> <fieldset>

				<div class="cont-title">
                    <img src="img/logo.png" alt="logo">
					<h1 class="titolo"> Esegui l'Accesso </h1>
                </div>

				<p> Inserisci qui i tuoi dati </p>

				<div class="cont-inserisci">
					<i class="fa-solid fa-circle-user"></i>
					<input type="email" placeholder="Username" class="inserisci" name="email" required>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock" onclick="icon_change()"></i>
					<input type="password" placeholder="Password" class="inserisci" id="pwd" name="password" maxlength="100" required>
				</div>

				<?php
					if(isset($_POST['accedi'])){
						session_start();
						$_SESSION["nomeUtente"] = $_POST["email"];
						$_SESSION["password"] = $_POST["password"];

						try{
							include "connessione.php";
							$sql = "SELECT a.nomeUtente, a.password, p.tipo FROM account a JOIN persona p ON a.ID_persona = p.ID_persona WHERE a.nomeUtente = '" .$_POST["email"]. "' AND a.password = '" .$_POST["password"]. "';";
							$result = $conn -> query($sql);
							$row = $result -> fetch_assoc();
							if((isset($row["nomeUtente"]) AND isset($row["password"])) AND ($row["nomeUtente"] === $_SESSION["nomeUtente"] AND $row["password"] === $_SESSION["password"])){
								$_SESSION['tipo'] = $row["tipo"];

								if($_SESSION["tipo"] == 1){
									header('location:studente.php');
									echo "<script type ='text/javascript'>";
									echo "location.href ='studente.php';";
									echo "</script>";
								} else if($_SESSION["tipo"] == 2){
									header('location:docente.php');
									echo "<script type ='text/javascript'>";
									echo "location.href ='docente.php';";
									echo "</script>";
								} else{
									throw new Exception("Tipo dell'account errato");
								}
							} else{
								throw new Exception("Errore nell'inserimento dei dati <br> Controlla che l'email o la password siano corrette");
							}
						}catch (Exception $e){
							echo $e -> getMessage();
						}

						$result -> free();
						$conn -> close();
					}
				?>
				
				<br>

				<div class="cont-button">
                    <input type="submit" value="Accedi" class="btn btn-accedi" name="accedi">

					<button class="btn btn-pwd" onclick="password();"> Password <br> Dimenticata? </button>
					<a href="registra.php" class="btn btn-registrati"> Registrati </a>
				</div>

			</fieldset> </form>
		</div>

	</body>
</html>