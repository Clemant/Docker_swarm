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
if(isset($_POST['pseudo'],$_POST['motdepasse'],$_POST['courriel'])) {
  $ccmpseudo=$_POST['pseudo'];
  $ccmmdp=$_POST['motdepasse'];
  $ccmmail=$_POST['courriel'];
  echo "OK $ccmpseudo ... <br />";

  //connexion à la base de données:
  include("conf.php");
  
  $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(!$mysqli) {
    echo "<br /><strong>Connexion non établie.</strong><br />";
  } else {
    echo "Connection ok ...<br>";
  
  if(!mysqli_query($mysqli,"INSERT INTO membres SET ccmpseudo='".$ccmpseudo."', mdp='".md5($ccmmdp)."', ccmmail='".$ccmmail."'")){
    echo "Une erreur s'est produite: ".mysqli_error($mysqli);
  } else {
    echo "Vous êtes inscrit avec succès!";
  }
 
  mysqli_close($mysqli);
  }
} else {
  echo "ERREUR : Certains champs sont vides ...<br />";
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
