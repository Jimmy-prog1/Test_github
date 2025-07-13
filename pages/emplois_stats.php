<?php require("traitement6.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Statistiques des emplois</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h1>Statistiques des emplois</h1>
    <table class="table table-bordered table-striped">
      <tr class="table-dark">
        <th>Emploi</th>
        <th>Nombre d'hommes</th>
        <th>Nombre de femmes</th>
        <th>Salaire moyen</th>
      </tr>
      <?php while ($emploi = mysqli_fetch_assoc($resultat)) { ?>
      <tr>
        <td><?php echo $emploi['title']; ?></td>
        <td><?php echo $emploi['nb_hommes']; ?></td>
        <td><?php echo $emploi['nb_femmes']; ?></td>
        <td><?php echo number_format($emploi['salaire_moyen'], 2, ',', ' '); ?> €</td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
