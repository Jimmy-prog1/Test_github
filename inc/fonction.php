<?php
function recupererDepartements($mysqli) {
    $requete = "SELECT * FROM v_departements_manager_employes ORDER BY dept_name";
    $resultat = mysqli_query($mysqli, $requete);
    return $resultat;
}


function recupererEmployesParDepartement($mysqli, $nom_departement) {
    $requete = "
        SELECT * FROM v_employes_par_departement
        WHERE dept_name = '$nom_departement'
        ORDER BY last_name, first_name
    ";
    $resultat = mysqli_query($mysqli, $requete);
    return $resultat;
}

function recupererEmploye($mysqli, $emp_no) {
    $requete = "
        SELECT * FROM v_fiche_employe
        WHERE emp_no = $emp_no
    ";
    $resultat = mysqli_query($mysqli, $requete);
    return mysqli_fetch_assoc($resultat);
}

function recupererHistoriqueSalaires($mysqli, $emp_no) {
    $requete = "
        SELECT * FROM v_salaire_employe
        WHERE emp_no = $emp_no
        ORDER BY from_date DESC
    ";
    $resultat = mysqli_query($mysqli, $requete);
    return $resultat;
}

// Récupérer l'historique des emplois occupés d'un employé
function recupererHistoriqueEmplois($mysqli, $emp_no) {
    $requete = "
        SELECT * FROM v_emplois_employe
        WHERE emp_no = $emp_no
        ORDER BY from_date DESC
    ";
    $resultat = mysqli_query($mysqli, $requete);
    return $resultat;
}

function rechercherEmployes($mysqli, $departement = "", $nom = "", $age_min = "", $age_max = "", $offset = 0, $limit = 20) {
    $requete = "
        SELECT e.emp_no, e.first_name, e.last_name, e.birth_date, e.hire_date, d.dept_name
        FROM employees e
        JOIN dept_emp de ON e.emp_no = de.emp_no
        JOIN departments d ON de.dept_no = d.dept_no
        WHERE de.to_date = '9999-01-01'
    ";

    if ($departement != "") {
        $requete .= " AND d.dept_name = '$departement'";
    }

    if ($nom != "") {
        $requete .= " AND (e.first_name LIKE '%$nom%' OR e.last_name LIKE '%$nom%')";
    }

    if ($age_min != "") {
        $requete .= " AND e.birth_date <= '$age_min'";
    }

    if ($age_max != "") {
        $requete .= " AND e.birth_date >= '$age_max'";
    }

    $requete .= " ORDER BY e.last_name, e.first_name";
    $requete .= " LIMIT $offset, $limit";

    $resultat = mysqli_query($mysqli, $requete);
    return $resultat;
}

function recupererStatsEmplois($mysqli) {
    $requete = "SELECT * FROM v_emplois_stats";
    $resultat = mysqli_query($mysqli, $requete);
    if (!$resultat) {
        die("Erreur SQL : " . mysqli_error($mysqli));
    }
    return $resultat;
}


?>
