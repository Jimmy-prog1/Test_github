<?php
require("../inc/connexion.php");
require("../inc/fonction.php");
$mysqli = dbconnect();

// Récupération des filtres depuis l'URL (GET)
$departement = $_GET['departement'] ?? "";
$nom = $_GET['nom'] ?? "";
$age_min = $_GET['age_min'] ?? "";
$age_max = $_GET['age_max'] ?? "";

// Gestion de l'offset pour pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Récupération des résultats avec pagination
$resultat = rechercherEmployes($mysqli, $departement, $nom, $age_min, $age_max, $offset, $limit);

// Pour savoir s'il y a plus de résultats, on récupère un résultat supplémentaire
$limit_plus = $limit + 1;
$query_plus = "
    SELECT e.emp_no, e.first_name, e.last_name, e.birth_date, e.hire_date, d.dept_name
    FROM employees e
    JOIN dept_emp de ON e.emp_no = de.emp_no
    JOIN departments d ON de.dept_no = d.dept_no
    WHERE de.to_date = '9999-01-01'
";


if ($departement != "") {
    $query_plus .= " AND d.dept_name = '$departement'";
}

if ($nom != "") {
    $query_plus .= " AND (e.first_name LIKE '%$nom%' OR e.last_name LIKE '%$nom%')";
}

if ($age_min != "") {
    $query_plus .= " AND e.birth_date <= '$age_min'";
}

if ($age_max != "") {
    $query_plus .= " AND e.birth_date >= '$age_max'";
}

$query_plus .= " ORDER BY e.last_name, e.first_name";
$query_plus .= " LIMIT $offset, $limit_plus";

$resultat_plus = mysqli_query($mysqli, $query_plus);
$rows = [];
while ($row = mysqli_fetch_assoc($resultat_plus)) {
    $rows[] = $row;
}
$has_next_page = count($rows) > $limit;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Résultats de la recherche</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
  <h1>Résultats de la recherche</h1>
  <a href="recherche.php" class="btn btn-secondary mb-3">Nouvelle recherche</a>
  <table class="table table-bordered table-striped">
    <tr class="table-dark">
      <th>Numéro</th>
      <th>Prénom</th>
      <th>Nom</th>
      <th>Date de naissance</th>
      <th>Date d'embauche</th>
      <th>Département</th>
    </tr>
    <?php
    // On affiche au maximum $limit résultats (car $rows contient $limit+1 max)
    for ($i = 0; $i < min(count($rows), $limit); $i++) {
        $emp = $rows[$i];
        echo "<tr>";
        echo "<td>" . $emp['emp_no'] . "</td>";
        echo "<td>" . $emp['first_name'] . "</td>";
        echo "<td>" . $emp['last_name'] . "</td>";
        echo "<td>" . $emp['birth_date'] . "</td>";
        echo "<td>" . $emp['hire_date'] . "</td>";
        echo "<td>" . $emp['dept_name'] . "</td>";
        echo "</tr>";
    }
    ?>
  </table>

  <nav aria-label="Pagination">
    <ul class="pagination">
      <?php if ($page > 1) { ?>
        <li class="page-item">
          <a class="page-link" href="?departement=<?php echo urlencode($departement); ?>&nom=<?php echo urlencode($nom); ?>&age_min=<?php echo urlencode($age_min); ?>&age_max=<?php echo urlencode($age_max); ?>&page=<?php echo $page - 1; ?>">Précédent</a>
        </li>
      <?php } else { ?>
        <li class="page-item disabled"><span class="page-link">Précédent</span></li>
      <?php } ?>

      <li class="page-item active"><span class="page-link"><?php echo $page; ?></span></li>

      <?php if ($has_next_page) { ?>
        <li class="page-item">
          <a class="page-link" href="?departement=<?php echo urlencode($departement); ?>&nom=<?php echo urlencode($nom); ?>&age_min=<?php echo urlencode($age_min); ?>&age_max=<?php echo urlencode($age_max); ?>&page=<?php echo $page + 1; ?>">Suivant</a>
        </li>
      <?php } else { ?>
        <li class="page-item disabled"><span class="page-link">Suivant</span></li>
      <?php } ?>
    </ul>
  </nav>
</div>
</body>
</html>
