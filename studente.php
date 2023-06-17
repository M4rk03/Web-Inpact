<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Home page studente</title>
		<meta charset="utf-8"/>
        <meta name="author" content="Web inpact"/>
		<link rel="stylesheet" href="stile.css" type="text/css"/>
	</head>
	
	<body>
		<div id="header">
			<div id="logo"><img src="img/logo.png" alt="logo Web Inpact" style="width:100px;"></div>
			<div id="intestazione"><h1 style="color:#C4282B;font-family:Mont;font-size:50px;text-align:center;margin-top:-87px;">HOME PAGE STUDENTE</h1></div>
			<div id="account" style="background-color:#FFEB00;width:82px;height:82px;float:right;font-family:Mustica;text-align:center;border-radius:10px;margin-top:-111px;margin-right:9px;"><a href="login.php"><img src="img/account.png" id="login" alt="login" style="width:54px;margin-top:5px;margin-left:4px;"></a><p style="margin:-6px 0px 0px 3px;">Logout</p></div>
		</div>
		
		<div id="contenuto" style="font-family:Mont;padding:20px;">
			<p style="font-size:18px;font-weight:bold;text-align:center;margin-top:0;">Eleco dei badge assegnati a <b style="font-size:22px;">
				<?php
					include "connessione.php";
					
					session_start();
					$sql="SELECT cognome, nome FROM Persona WHERE ID_persona=".$_SESSION["nomeUtente"];
					$result=$conn->query($sql);
					$row=$result->fetch_assoc();
					print_r(" ".$row["cognome"]." ".$row["nome"]."\n<br>");
					$result->free();
					$conn->close();
				?></b>
			</p>
			<div id="visBadge" style="background-color:#FEF898;border-radius:10px;padding:12px;">
				<?php
					include "connessione.php";
					
					//visualizzare tutti i badge assegnati
					$sql="SELECT Badge.codBadge, Badge.nome, Badge.livello FROM Persona JOIN Assegna_Visualizza ON Persona.ID_persona = Assegna_Visualizza.ID_persona JOIN Badge ON (Assegna_Visualizza.codBadge = Badge.codBadge) AND (Assegna_Visualizza.livello = Badge.livello) JOIN Account ON Persona.ID_persona = Account.nomeUtente WHERE Account.nomeUtente =".$_SESSION["nomeUtente"];
					try{
					  $result=$conn->query($sql);
					  while($row=$result->fetch_assoc()){
						$badge=$row["codBadge"]."_".$row["livello"];
						$nome=strtolower($row["codBadge"]);
						$img=$row["nome"]."".$row["livello"];
						echo "<img src='img/badge/".$img.".png' name='".$badge."' style=\"width:8%;margin-left:20px;\">";
					  }
					}catch(Exception $e){
					  echo ("<p id=\"noBadge\">Non è stato trovato nessun badge</p>");
					}
					$result->free();
					$conn->close();
				?>
			</div>
		</div>
		
		<div id="footer">
			<img src="img/logo.png" id="logonome" alt="logo Web Inapact" style="width:80px;float:left;"> <img src="img/scritta.png" id="logonome" alt="scritta Web Imapact" style="width:172px;float:left;margin-top:-2px;margin-left:-8px">
			<img src="img/dalcero.png" id="dalcero" alt="logo DalCero" style="width:86px;float:right;margin-top:1px">
			<class class="dalcero" style="width:90%;color:#C4282B;font-family:Mont;font-size:24px;position:absolute;margin-left:-50%;margin-top:3px;">ISISS "M.O. Luciano Dal Cero"</class>
			<class class="social" style="width:96%;position:absolute;margin-top:36px;margin-left:-55%;"><div style="display:block;margin:0 auto;">
				<a href="https://web.whatsapp.com/"><img src="img/whatsapp.png" id="whatsapp" alt="logo Whatsapp" style="width:40px;margin-left:4%;"></a>
				<a href="https://mail.google.com/"><img src="img/email.png" id="email" alt="logo Email" style="width:40px;margin-left:10%;"></a>
				<a href="https://it-it.facebook.com/"><img src="img/facebook.png" id="facebook" alt="logo Facebook" style="width:40px;margin-left:10%;"></a>
				<a href="https://www.instagram.com/accounts/login/"><img src="img/instagram.png" id="instagram" alt="logo Instagram" style="width:40px;margin-left:10%;"></a>
			</div></class>
		</div>
	</body>
</html>