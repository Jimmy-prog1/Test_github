<?php
require("../inc/connexion.php");
require("../inc/fonction.php");
$mysqli = dbconnect();

// Récupérer la liste des départements pour la liste déroulante
$liste_depts = mysqli_query($mysqli, "SELECT dept_name FROM departments ORDER BY dept_name");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Recherche Employés</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
  <h1>Recherche d'employés</h1>
  <form method="get" action="resultats_recherche.php" class="mb-4">
    <div class="mb-3">
      <label for="departement" class="form-label">Département</label>
      <select name="departement" id="departement" class="form-select">
        <option value="">-- Tous --</option>
        <?php while ($dept = mysqli_fetch_assoc($liste_depts)) { ?>
          <option value="<?php echo $dept['dept_name']; ?>"><?php echo $dept['dept_name']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="nom" class="form-label">Nom employé</label>
      <input type="text" name="nom" id="nom" class="form-control" placeholder="Prénom ou nom" />
    </div>
    <div class="mb-3">
      <label for="age_min" class="form-label">Âge minimum</label>
      <input type="number" name="age_min" id="age_min" class="form-control" min="0" max="120" />
    </div>
    <div class="mb-3">
      <label for="age_max" class="form-label">Âge maximum</label>
      <input type="number" name="age_max" id="age_max" class="form-control" min="0" max="120" />
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </form>
</div>
</body>
</html>
