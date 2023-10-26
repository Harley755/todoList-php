<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <script src="../css/bootstrap/js/bootstrap.js"></script>
    <title>Rechercher</title>
</head>

<body>
    <div class="container mt-3">
        <a href="./index.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Reherche d'informations de séjour</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row col-md-12 mt-4">
                            <div class="row col-md-12">
                                <div class="mb-2 col">
                                    <div>
                                        <label for="description" class="col-md col-form-label">Description de la tâche</label>
                                    </div>

                                    <div class="col">
                                        <textarea id="description" name="description" type="text" class="form-control" autofocus required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <input type="submit" class="btn btn-primary mt-4" value="Rechercher">&nbsp;
                            <input type="reset" class="btn btn-danger mt-4" value="Annuler">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?php
        include '../configuration/connexion.inc.php';

        if (isset($_POST['description'])) {
            if (!empty($_POST['description'])) {
                $description = htmlspecialchars(strip_tags($_POST['description']));

                // RECUPERER L'ID DU VOYAGEUR DONC LES INFOS SONT RENSEIGNEES
                $searchRequest = "SELECT * FROM tasks WHERE description = :description";
                $stmp = $pdo->prepare($searchRequest);
                $stmp->bindParam(':description', $description);
                if ($stmp->execute()) {
                    $ans = $stmp->fetchAll();
                    if (!count($ans) > 0) {
                        echo "
                            <script>
                            alert('Aucune tache trouvé');
                            window.location.href='../views/search.php';
                            </script>
                        ";
                    }
                    echo " <div class='col-md-12 shadow p-3 bg-body rounded'>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>Description</th>";
                    echo "<th scope='col'>Créée le</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    if (count($ans) > 0) {
                        foreach ($ans as $answer) {
                            echo "<tr>";
                            echo "<td>" . $answer['description'] . "</td>";
                            echo "<td>" . $answer['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan=4 class='text-center'>Aucune information trouvée</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo " </div>";
                }
            }
        } else {
            echo "<div class='col-md-12 shadow p-3 bg-body rounded'>";
            echo 'Indiquez la description !';
            echo "</div>";
        }
        ?>
    </div>

    <!-- <script>
        console.log(document.myform.elements.length);
    </script> -->
</body>

</html>