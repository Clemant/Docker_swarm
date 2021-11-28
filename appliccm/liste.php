<!doctype html>
<html lang="fr">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>MasterCCM</title>
</head>
<body bgcolor="AADDEE">
<center>
<table border="0" width="100%">
<tr>
<td width="100px"><img src="test.png" /></td>
<td align="center"><b>Master CCM</b></td>
<td width="100px"></td>
</tr>
</table>
<hr />

<div style="width:50%; padding:3px; border:2px dotted #a5a5a5; background-color:#e3e3e3;">
<strong>Application CCM M2</strong><br />
<br />

<?php
  //connexion à la base de données:
  include("conf.php");

  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname); // on instancie la classe mysqli

  if ($mysqli->connect_errno) { // appel de méthode avec l'opérateur ->
    printf("Échec de la connexion : %s\n", $mysqli->connect_error); 
  } else {
    echo "Connection ok ...<br>";
  
  $requete = "SELECT * FROM membres";
  $resultat = $mysqli -> query($requete);
  while ($ligne = $resultat -> fetch_assoc()) {
    echo $ligne['ccmpseudo'] . ' ' . $ligne['mdp'] . ' ' . $ligne['ccmmail'] . '<br />';
  }
  $mysqli->close();
  }



?>
<br />
<br />
Retour page principale : <a href="index.html">ICI</a><br />
</div>
<br />
<hr />
&copy; Copyright 2020 CCM
</center>
</body>
</html>
