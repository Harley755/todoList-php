<?php
include '../configuration/connexion.inc.php';

// Get all equipe
$equipeRequest = "SELECT * FROM equipe";
$equipeList = $pdo->query($equipeRequest);
$equipes = $equipeList->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <script src="../css/bootstrap/js/bootstrap.js"></script>
    <title>Creation d'un match</title>
</head>

<body>
    <div class="container mt-3">
        <a href="./menu.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Rehercher joueur par équipe</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row col-md-12 mt-4">
                            <div class="col">
                                <select class="form-control" name="idequipe" id="idequipe" required>
                                    <option value="">Veuillez selectionner une équipe</option>
                                    <?php foreach ($equipes as $equipe) : ?>
                                        <option value="<?= $equipe['idequipe'] ?>"><?= $equipe['nomequipe'] ?></option>
                                    <?php endforeach ?>
                                </select>
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

        if (isset($_POST['idequipe']) && !empty($_POST['idequipe'])) {
            $idequipe = htmlspecialchars(strip_tags($_POST['idequipe']));

            $searchRequest = "SELECT * FROM joueur WHERE idequipe = :idequipe";
            $stmp = $pdo->prepare($searchRequest);
            $stmp->bindParam(':idequipe', $idequipe);
            $stmp->execute();
            if ($stmp->execute()) {
                $answers = $stmp->fetchAll();

                # code...

                echo " <div class='col-md-12 shadow p-3 bg-body rounded'>";
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>Nom</th>";
                echo "<th scope='col'>Prénoms</th>";
                echo "<th scope='col'>Contact</th>";
                echo "<th scope='col'>Poste</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                if (count($answers) > 0) {
                    foreach ($answers as $answer) {
                        echo "<tr>";
                        echo "<td>" . $answer['nomjoueur'] . "</td>";
                        echo "<td>" . $answer['prenomjoueur'] . "</td>";
                        echo "<td>" . $answer['contactjoueur'] . "</td>";
                        echo "<td>" . $answer['postejoueur'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan=4 class='text-center'>Aucun joueur n'appartient à cette équipe</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo " </div>";
            }
        } else {
            echo "<div class='col-md-12 shadow p-3 bg-body rounded'>";
            echo 'Indiquez l\'équipe !';
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>