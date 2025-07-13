<?php
require("../inc/connexion.php");
require("../inc/fonction.php");

$mysqli = dbconnect();
$resultat = recupererDepartementsAvecNbEmployes($mysqli);
?>
