<?php
require("../inc/connexion.php");
require("../inc/fonction.php");

if (isset($_GET['emp_no'])) {
    $emp_no = $_GET['emp_no'];
} else {
    die("Employé non spécifié.");
}

$mysqli = dbconnect();
$employe = recupererEmploye($mysqli, $emp_no);
$historique_salaires = recupererHistoriqueSalaires($mysqli, $emp_no);
$historique_emplois = recupererHistoriqueEmplois($mysqli, $emp_no);
?>
