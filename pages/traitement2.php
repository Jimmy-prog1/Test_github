<?php
require("../inc/connexion.php");
require("../inc/fonction.php");

if (isset($_GET['dept'])) {
    $dept = $_GET['dept'];
} else {
    die("Département non spécifié.");
}

$mysqli = dbconnect();
$resultat = recupererEmployesParDepartement($mysqli, $dept);
?>
