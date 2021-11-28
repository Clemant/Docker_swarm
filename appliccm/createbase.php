<?php
  include("conf.php");
  $mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(!$mysqli) {
    echo "Connexion non établie\n";
  } else {
    $mysqli2=mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS `".$dbname."`.`membres` ( `id` INT NOT NULL AUTO_INCREMENT , `ccmpseudo` VARCHAR(25) NOT NULL , `mdp` CHAR(32) NOT NULL , `ccmmail` CHAR(32) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM;");
    if(!$mysqli2) {
      echo "Erreur de création\n";
      echo mysqli_error($mysqli2);
    }  
  }
?>
