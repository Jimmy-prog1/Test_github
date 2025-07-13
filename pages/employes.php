<?php require("traitement2.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Employés du département <?php echo $dept; ?></title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h1>Employés du département : <?php echo $dept; ?></h1>
    <a href="departements.php" class="btn btn-secondary mb-3">Retour aux départements</a>
    <a href="recherche.php" class="btn btn_secondary mb-3">Voulez vous effectuer un recherche ?</a>
    <table class="table table-bordered table-striped">
      <tr class="table-dark">
        <th>Numéro</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Date d'embauche</th>
      </tr>
      <?php
      while ($emp = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>" . $emp['emp_no'] . "</td>";
        // Le prénom devient un lien vers la fiche de l'employé
        echo "<td><a href='fiche_employe.php?emp_no=" . $emp['emp_no'] . "&dept=" . $dept . "'>" . $emp['first_name'] . "</a></td>";
        // Le nom reste simple affichage (tu peux aussi faire lien ici si tu préfères)
        echo "<td>" . $emp['last_name'] . "</td>";
        echo "<td>" . $emp['hire_date'] . "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>