<?php require("traitement1.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des départements</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Liste des départements</h1>
    <table class="table table-bordered table-striped">
      <tr class="table-dark">
        <th>Nom du département</th>
        <th>Manager actuel</th>
        <th>Nombre d'employés</th>
      </tr>
      <?php
      while ($dept = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td><a href='employes.php?dept=" . $dept['dept_name'] . "'>" . $dept['dept_name'] . "</a></td>";
        echo "<td>" . $dept['first_name'] . " " . $dept['last_name'] . "</td>";
        echo "<td>" . $dept['nombre_employes'] . "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
