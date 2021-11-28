#!/usr/bin/env php
<?php
error_reporting(E_ALL);

/* Autorise l'exécution infinie du script, en attente de connexion. */
set_time_limit(0);

/* Active le vidage implicite des buffers de sortie, pour que nous
 * puissions voir ce que nous lisons au fur et à mesure. */
ob_implicit_flush();

//$address = '192.168.1.53';
$address = '0.0.0.0';
$port = 9013;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() a échoué : raison : " . socket_strerror(socket_last_error()) . "\n";
	exit(1);
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() a échoué : raison : " . socket_strerror(socket_last_error($sock)) . "\n";
	exit(1);
}

if (socket_listen($sock, 5) === false) {
    echo "socket_listen() a échoué : raison : " . socket_strerror(socket_last_error($sock)) . "\n";
	exit(1);
}


//connexion à la base de données:
include("conf.php");

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname); // on instancie la classe mysqli

if ($mysqli->connect_errno) { // appel de méthode avec l'opérateur ->
	printf("ERROR\n"); 
	exit(1);
}

do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() a échoué : raison : " . socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }
    socket_getpeername($msgsock,$client);
    $madate=date("Y-m-d H:i:s");
    echo "$madate-$client\n";
    /* Send instructions. */
//    $msg = "\Bienvenue sur le serveur de test PHP.\n" .
//        "Pour quitter, tapez 'quit'. Pour éteindre le serveur, tapez 'shutdown'.\n";

  $requete = "SELECT * FROM membres";
    $resultat = $mysqli -> query($requete);
    $msg="";
    echo($resultat->fetch_assoc());
  while ($ligne = $resultat -> fetch_assoc()) {
    $msg.=$ligne['ccmpseudo']. ';'.$ligne['mdp'].';'.$ligne['ccmmail']."\n";
  }

    socket_write($msgsock, $msg, strlen($msg));
/*
    do {
        if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() a échoué : raison : " . socket_strerror(socket_last_error($msgsock)) . "\n";
            break 2;
        }
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        $talkback = "PHP: You said '$buf'.\n";
        socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    } while (true);
 */
    socket_close($msgsock);
} while (true);
$mysqli->close();

socket_close($sock);
?>
