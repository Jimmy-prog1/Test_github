<?php require("traitement3.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Fiche Employé : <?php echo $employe['first_name'] . ' ' . $employe['last_name']; ?></title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Fiche Employé</h1>
    <p><strong>Nom :</strong> <?php echo $employe['last_name']; ?></p>
    <p><strong>Prénom :</strong> <?php echo $employe['first_name']; ?></p>
    <p><strong>Date de naissance :</strong> <?php echo $employe['birth_date']; ?></p>
    <p><strong>Sexe :</strong> <?php echo $employe['gender']; ?></p>
    <p><strong>Date d’embauche :</strong> <?php echo $employe['hire_date']; ?></p>

    <h2>Historique des salaires</h2>
    <table class="table table-bordered table-striped">
        <tr class="table-dark">
            <th>Salaire</th>
            <th>Du</th>
            <th>Au</th>
        </tr>
        <?php
        while ($salaire = mysqli_fetch_assoc($historique_salaires)) {
            echo "<tr>";
            echo "<td>" . $salaire['salary'] . "</td>";
            echo "<td>" . $salaire['from_date'] . "</td>";
            echo "<td>" . $salaire['to_date'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Historique des emplois</h2>
    <table class="table table-bordered table-striped">
        <tr class="table-dark">
            <th>Département</th>
            <th>Du</th>
            <th>Au</th>
        </tr>
        <?php
        while ($emploi = mysqli_fetch_assoc($historique_emplois)) {
            echo "<tr>";
            echo "<td>" . $emploi['dept_name'] . "</td>";
            echo "<td>" . $emploi['from_date'] . "</td>";
            echo "<td>" . $emploi['to_date'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="employes.php?dept=<?php echo $_GET['dept'] ?? ''; ?>" class="btn btn-secondary mt-3">Retour</a>
</div>
</body>
</html>
