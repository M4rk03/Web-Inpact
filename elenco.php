<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Registro Classe</title>
		<meta charset="utf-8"/>
        <meta name="author" content="Web inpact"/>
		<link rel="stylesheet" href="stile.css" type="text/css"/>
	</head>
	
	<body>
		<div id="header">
			<div id="logo"><img src="img/logo.png" alt="logo Web Inpact" style="width:100px;"></div>
			<div id="intestazione"><h1 style="color:#C4282B;font-family:Mont;font-size:50px;text-align:center;margin-top:-87px;">REGISTRO ALUNNI</h1></div>
			<div id="account" style="background-color:#FFEB00;width:82px;height:82px;float:right;font-family:Mustica;text-align:center;border-radius:10px;margin-top:-111px;margin-right:9px;"><a href="login.php"><img src="img/account.png" id="login" alt="login" style="width:54px;margin-top:5px;margin-left:4px;"></a><p style="margin:-6px 0px 0px 3px;">Logout</p></div>
		</div>
		
		<div id="contenuto" style="font-family:Mont;padding:20px;">
			<p style="font-size:18px;font-weight:bold;text-align:center;margin-top:0;">Registro di classe di <b style="font-size:22px;">
				<?php
					echo " ".$_POST["anno"]." ".$_POST["sezione"]."\n";
				?></b>
			</p>
			<div id="elenco" style="background-color:#FEF898;border-radius:10px;padding:12px;">
				<table style="width:100%">
				  <tr id="titoli" style="font-size:16px;">
					<th id="C&N" colspan="2"><p style="background-color:white;border:3px solid #C4282B;border-radius:10px;margin-top:0;padding:6px;">Cognome e Nome alunno</p></th>
					<th id="bAss"><p style="background-color:white;border:3px solid #C4282B;border-radius:10px;margin-top:0;padding:6px;">Badge assegnati</p></th>
				  </tr>
				  <?php
					include "connessione.php";
					
					$sql1="SELECT DISTINCT * FROM Persona p INNER JOIN classe c ON c.anno=".$_POST["anno"]." AND c.sezione='".$_POST["sezione"]."' INNER JOIN studente s ON p.ID_persona=s.ID_studente AND s.ID_classe=c.ID_classe WHERE tipo=1";
					$result1=$conn->query($sql1);
					$num=0;
					while($row1=$result1->fetch_assoc()){
					  $num++;
					  echo "<tr>\n";
					  echo "<th style=\"width:0;border-bottom:2px solid darkgrey;\">".$num."</th>    <th style=\"width:26%;text-align:left;border-bottom:2px solid darkgrey;\">".$row1["cognome"]." ".$row1["nome"]." <p style=\"font-family:Mustica;font-size:14px;margin:0;\">".$row1["dataNascita"]."</p></th>\n";
					  echo "CODICE MATERIA: ".$_POST["materia"];
					  #$sql2="SELECT b.codBadge, b.nome, b.livello FROM Persona p INNER JOIN Assegna_Visualizza v ON p.ID_persona = v.ID_persona INNER JOIN Badge b ON v.codBadge = b.codBadge AND v.livello = b.livello INNER JOIN Account a ON p.ID_persona = a.nomeUtente WHERE a.nomeUtente =".$row1["ID_persona"];
					  $sql2="SELECT b.codBadge, b.nome, b.livello FROM Badge b INNER JOIN Persona p ON p.ID_persona=".$row1["ID_persona"]." INNER JOIN Assegna_Visualizza v ON v.ID_persona=p.ID_persona AND v.codBadge=b.codBadge AND b.livello=v.livello WHERE b.materia=".$_POST["materia"];
					  #$sql2="SELECT b.nome, b.livello, v.dataB FROM badge b JOIN assegna_visualizza v ON b.codBadge = v.codBadge AND b.livello = v.livello INNER JOIN account a ON v.ID_persona = a.ID_persona WHERE a.nomeUtente = '" .$_SESSION["nomeUtente"]. "' AND b.materia = " .$row1["ID"];
					  $result2=$conn->query($sql2);
					  echo "<th style=\"text-align:left;border-bottom:2px solid darkgrey;padding-left:1%;\">";
					  while($row2=$result2->fetch_assoc()){
						$badge=$row2["codBadge"]."_".$row2["livello"];
						$img=$row2["nome"]."".$row2["livello"];
						echo "<img src='img/badge/".$img.".png' name='".$badge."' style=\"width:40px;float:left;margin-left:10px\">";
					  }
					  echo "\n<form style=\"background-color:transparent;width:44px;float:left;margin:0;margin-left:20px;\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><input type=\"image\" src='img/addB.png' name='aggiungi' alt=\"add\" style=\"width:44px;\"></form></th>\n";
					  echo "</tr>\n";
					}
				  ?>
				</table>
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