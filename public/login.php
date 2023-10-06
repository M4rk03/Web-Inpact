<?php 
	require_once('../init.php');

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		// se sei loggato esce dall'account
        if (isset($_SESSION['nomeUtente'])) {
            session_destroy();
            redirect();
        }
	}
?>

<!DOCTYPE html>
<html lang="it" class="persona">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="./media/img/logo.webp">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./media/fontawesome-icon/css/all.css">

		<title> WebInpact - Login </title>
		
	</head>
	
	<body class="persona">

		<a href="./index.php" class="btn-icon"> <i class="fa-solid fa-house"></i> </a>
	
		<div class="cont-data">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form"> <fieldset>

				<div class="cont-title">
					<h1 class="titolo"> Esegui l'Accesso </h1>
                </div>

				<p> Inserisci qui i tuoi dati </p>

				<div class="cont-inserisci">
					<i class="fa-solid fa-circle-user"></i>
					<input type="email" placeholder="Username" class="inserisci in_data" name="email" required>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock" onclick="icon_change(this)"></i>
					<input type="password" placeholder="Password" class="inserisci in_data" id="pwd" name="password" maxlength="100" required>
				</div>

				<?php
					if(isset($_POST['accedi'])){
						include "../connessione.php";

						$email = $_POST["email"];
						$password = $_POST["password"];

						try{
							$sql = "SELECT a.nomeUtente, a.password, p.tipo FROM account a JOIN persona p ON a.ID_persona = p.ID_persona WHERE a.nomeUtente = '" .$email. "' AND a.password = '" .$password. "';";
							$result = $conn -> query($sql);
							$row = $result -> fetch_assoc();
							
							if((isset($row["nomeUtente"]) AND isset($row["password"])) AND ($row["nomeUtente"] === $email AND $row["password"] === $password)){
								$_SESSION["nomeUtente"] = $email;
								$tipo = $row["tipo"];

								if($tipo == 1){
									redirect('studente.php');
								} else if($tipo == 2){
									redirect('docente.php');
								} else{
									throw new Exception("<p class='error'> Tipo dell'account errato </p>");
								}
							} else{
								throw new Exception("<p class='error'> Errore nell'inserimento dei dati <br> Controlla che l'email o la password siano corrette </p>");
							}
						}catch (Exception $e){
							echo '<div>'.$e -> getMessage().'</div>';
						}

						$result -> free();
						$conn -> close();
					}
				?>
				
				<br>

				<div class="cont-button">
                    <input type="submit" value="Accedi" class="btn-primary btn-accedi" name="accedi">

					<a class="btn-primary btn-pwd"> Password <br> Dimenticata? </a>
					<a href="./registra.php" class="btn-primary btn-secondary btn-registrati"> Registrati </a>
				</div>

			</fieldset> </form>
		</div>

		<script src="./js/myScript.js"></script>
	</body>
</html>