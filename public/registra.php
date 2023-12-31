<?php require_once('../init.php'); ?>

<!DOCTYPE html>
<html lang="it">
    <head>

		<meta charset="UTF-8">
		<meta name="author" content="Web Inpact"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="icon" type="image/x-icon" href="./media/img/logo.webp">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./media/fontawesome-icon/css/all.css">

		<title> WebInpact - Registrazione </title>
		
	</head>
	
	<body>

		<a href="./login.php" class="btn-icon" style="left:14px;right:auto;"> <i class="fa-solid fa-caret-left"></i> </a>
		<a href="./index.php" class="btn-icon"> <i class="fa-solid fa-house"></i> </a>
	
		<div class="cont-data cont-signup">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form"> <fieldset>

				<div class="cont-title">
					<h1 class="titolo"> Registrazione </h1>
                </div>

				<p> Completa tutti i campi </p>

				<div id="signup">
					<div class="cont-inserisci">
						<label> Matricola: </label>
						<?php
							include "../connessione.php";
							$sql = "SELECT MAX(ID_persona) AS id FROM Persona";
							$result = $conn -> query($sql);
							$row = $result -> fetch_assoc();
							$id = $row["id"] + 1;
							echo "<input type='number' class='inserisci' name='ID_persona' value='" .$id. "' readonly>";
							$result -> free();
							$conn -> close();
						?>
					</div>
					
					<div class="cont-inserisci">
						<label> Nome: </label>
						<input type="text" class="inserisci" name="nome" required>
					</div>

					<div class="cont-inserisci">
						<label> Cognome: </label>
						<input type="text" class="inserisci" name="cognome" required>
					</div>

					<div class="cont-inserisci">
						<label> Data di Nascita: </label>
						<input type="date" class="inserisci" name="dataN" required>
					</div>

					<div class="caselle">
						<div class="radio">
							<input type="radio" id="M" name="sesso" value="M" onchange="checkRadio(this)" required>
							<label for="M"> 
								<i class="fa-regular fa-circle" id="male"></i> 
								Maschio 
							</label> <i class="fa-solid fa-mars" style="color: blue;"></i>
						</div>
						
						<div class="radio">
							<input type="radio" id="F" name="sesso" value="F" onchange="checkRadio(this)" required>
							<label for="F"> 
								<i class="fa-regular fa-circle" id="female"></i> 
								Femmina 
							</label> <i class="fa-solid fa-venus" style="color: magenta;"></i>
						</div>
					</div>

					<div class="cont-inserisci cont-select">
						<select onchange="select_control(this)" class="inserisci select" name="tipo_pers" required>
							<option value=""> Seleziona </option>
							<option value="2"> Docente </option>
							<option value="1"> Studente </option>
						</select> <i class="fa-solid fa-chevron-down"></i>
					</div>

					<!-- Solo per studente -->
					<div id="classe_anno" class="in_classe" style="display:none;">
						<label> Classe: </label> 
						
						<div class="cont-inserisci cont-select">
							<select class="inserisci select" name="anno">
								<option value=""> - </option>
								<option value="1"> 1 </option>
								<option value="2"> 2 </option>
								<option value="3"> 3 </option>
								<option value="4"> 4 </option>
								<option value="5"> 5 </option>
							</select> <i class="fa-solid fa-chevron-down" style="font-size:18px"></i>
						</div>

						<input type="text" placeholder="Sezione" class="inserisci" name="sezione" maxlength="4">
					</div>

					<!-- Solo per docente -->
					<div id="classe_doc" style="display:none;gap:28px;">

						<div class="cont-inserisci">
							<label> Le mie classi: </label> 
							
							<div class="grid-col-2">
								<div id="cl_tot" class="cont-select-class" ondrop="drop(event)" ondragover="allowDrop(event)">
									<?php
										include "../connessione.php";
						
										$sql = "SELECT COUNT(c.ID_classe) as num, c.ID_classe, c.anno, c.sezione FROM classe c JOIN studente s ON c.ID_classe = s.ID_classe GROUP BY c.ID_classe;";
										$result = $conn -> query($sql);
										
										// Parte ripetuta x la quantità delle classe
										try{
											while($row = $result->fetch_assoc()){
												if ($row['num'] > 1) {
													echo "<div id='ID_".$row["ID_classe"]."' class='grid-col-2 inserisci' ondragstart='dragStart(event)' draggable='true'> " .strtoupper($row["anno"])."".strtoupper($row["sezione"]). " <i class='fa-solid fa-plus'></i> </div>";
												}
											}

											$result1 = $conn -> query($sql);
											echo  "<select id='lettura_classe' class='inserisci select' name='classe[]' multiple hidden>";
											while($row1 = $result1->fetch_assoc()){
												echo "<option value='" .$row1["ID_classe"]. "'> " .$row1["anno"]. "" .$row1["sezione"]. " </option>";
											}
											echo "</select>";
										}
										catch (Exception $e){
											echo "Errore";
										}
					
										$result -> free();
										$result1 -> free();
										$conn -> close();
									?>
								</div>

								<div id="cl_inseg" class="cont-select-class" class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)"> </div>
							</div>
						</div>
						
						<div class="cont-inserisci in_classe">
							<label> Materia/e </label>
							
							<select class="inserisci select" name="materia[]" style="height:72px;" multiple>
								<?php
									include "../connessione.php";
					
									$sql = "SELECT * FROM materia;";
									$result = $conn -> query($sql);
									
									// Parte ripetuta x la quantità delle materie
									try{
										while($row = $result->fetch_assoc()){
											echo "<option value=" .$row["ID_materia"]. ">" .$row["nome"]. "</option>";
										}
									}
									catch (Exception $e){
										echo "Errore";
									}
				
									$result -> free();
									$conn -> close();
								?>
							</select>
							
							<div class="cont-inserisci" style="color:#000;"> <i class="fa-solid fa-circle-plus" onclick="addMateria()" style="cursor:pointer;"></i> </div>
						</div>

					</div>
				</div>

				<hr>

				<div class="cont-inserisci">
					<i class="fa-solid fa-circle-user"></i>
					<?php
						$email = "ciao" .$id. "@scuola.it";
						echo "<input type='email' placeholder='Username' class='inserisci in_data' name='email' value='" .$email. "' readonly>";
					?>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock" onclick="icon_change(this)"></i>
					<input type="password" placeholder="Password" class="inserisci in_data" id="pwd" name="pwd" maxlength="100" required>
				</div>

				<div class="cont-inserisci">
					<i class="fa-solid fa-lock" id="icon_lock2" onclick="icon_change(this)"></i>
					<input type="password" placeholder="Conferma Password" class="inserisci in_data" id="conf_pwd" name="conf_pwd" maxlength="100" required>
				</div>
				
				<div class="grid-col-2" style="margin-top:20px;">
					<input type="reset" onclick="refreshPage()" value="Cancella" class="btn-primary btn-secondary">
					<input type="submit" value="Conferma" class="btn-primary" name="invio">
				</div>

			</fieldset> </form>

			<?php
				if(isset($_POST['invio'])) {
					include '../connessione.php' ;

					$nome = $_POST["nome"];
					$cognome = $_POST["cognome"]; 
					$dataNascita = $_POST["dataN"];
					$sesso = $_POST["sesso"];
					$tipo = $_POST["tipo_pers"];
					
					$email = $_POST["email"];
					$pw = $_POST["pwd"];
					$cpw = $_POST["conf_pwd"];
					
					if($pw === $cpw){

						if (isset($tipo)) {
							try {
								$sql = "INSERT INTO persona(nome, cognome, dataNascita, sesso, tipo) VALUES ('".$nome."', '".$cognome."', '".$dataNascita."', '".$sesso."', ".$tipo.")";

								if ($conn->query($sql) === TRUE) {
									if ($tipo == 1){
										// INSERT per studente
										$anno = $_POST["anno"];
										$sezione = $_POST["sezione"];

										$sql1 = "SELECT ID_classe FROM classe WHERE anno = " .$anno. " AND sezione = '" .$sezione.  "';";
										$result = $conn -> query($sql1);
										$row = $result -> fetch_assoc();
			
										if (isset($row["ID_classe"])) {
											// Se esiste la classe
											$ID_classe = $row["ID_classe"];

										} else{
											// Se NON esiste la classe
											$sql2 = "INSERT INTO classe(anno, sezione) VALUES (".$anno.", '".$sezione."')";

											if ($conn->query($sql2) === TRUE){
												$sql1 = "SELECT ID_classe FROM classe WHERE anno = " .$anno. " AND sezione = '" .$sezione.  "';";
												$result1 = $conn -> query($sql1);
												$row1 = $result1 -> fetch_assoc();

												$ID_classe = $row1["ID_classe"];
											} else {
												echo "Errore nella creazione della classe <br> Riprova";
											}

											$result1 -> free();
										}
			
										$sql3 = "INSERT INTO studente(ID_studente, ID_classe) VALUES (".$id.", ".$ID_classe.")";

										if ($conn->query($sql3) === TRUE){
											echo "Persona con ID " .$id. " assegnata alla classe " .$anno. "" .$sezione. "<br>";
										} else {
											echo "Errore nell'assegnazione della classe <br> Riprova";
										}

										$result -> free();
			
									} else if ($tipo == 2){
										// INSERT per docente
										$classe = $_POST["classe"];
										$materia = $_POST["materia"];

										foreach ($materia as $i) {
											foreach ($classe as $j) {
												$sql1 = "INSERT INTO insegna(ID_persona, ID_materia, ID_classe) VALUES (".$id.", ".$i.", ".$j.")";
												
												if ($conn->query($sql1) === TRUE){
													echo "Persona con ID " .$id. " insegna alla classe con id " .$j. "<br>";
												} else {
													echo "Errore nell'assegnazione della materia e della classe <br> Riprova";
												}
											}
										}
									}
									
									$sql4 = "INSERT INTO account(nomeUtente, password, ID_persona) VALUES ('".$email."', '".$pw."', ".$id.")";

									if ($conn->query($sql4) === TRUE){
										echo "Persona con username " .$email. " registrata correttamente <br>";
									} else {
										echo "Errore nella registrazione dell'account <br> Riprova";
									}

								} else {
									echo "Errore nella registrazione della persona <br> Riprova";
								}

							} catch (Exception $e) {
								echo "Qualcosa è andato storto <br>";
								echo $e;
							}

						} else {
							echo "Non hai inserito il tipo della persona";
						}
							

					} else {
						echo "Le password inserite non corrispondono";
					}

					$conn -> close();
				} 
			?> 
		</div>

		<!-- Aggiungi materia -->
		<div id="add-materia" class="cont-popup">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form form-badge">
					
				<h2 class="titolo">Aggiungi materia</h2>
		
				<div class="cont-inserisci">
					<label> Materia: </label>
					<input type="text" id="ins-mat" class="inserisci" name="nome_mat">
				</div>
		
				<div class="grid-col-2" style="margin-top:20px;">
					<input type="reset" onclick="close_mat()" value="Chiudi" class="btn-primary btn-secondary">
					<input type="submit" value="Aggiungi" class="btn-primary" name="aggiungi">
				</div>

			</form>

			<?php
				if (isset($_POST['aggiungi'])) {
					include '../connessione.php' ;

					$nome_mat = $_POST["nome_mat"];
					
					try{
						$sql = "SELECT ID_materia FROM materia WHERE nome = '" .$nome_mat. "';";
						$result = $conn -> query($sql);
						$row = $result -> fetch_assoc();

						if (isset($row['ID_materia'])) {
							echo "Esiste già la materia";
						} else {
							$sql1 = "INSERT INTO materia(nome) VALUES ('".$nome_mat."')";

							if ($conn->query($sql1) === TRUE){
								echo "La materia è stato aggiunta correttamente";
							} else {
								echo "Errore nell'aggiunta della materia <br> Riprova";
							}
						}
							
						$result -> free();
						
					} catch (Exception $e){
						echo "Qualcosa è andato storto \n";
					}

					$conn -> close();
				}
			?>
		</div>

		<script src="./js/myScript.js"></script>
	</body>
</html>