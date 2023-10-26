<?php
include '../configuration/connexion.inc.php';

$idTask = $_GET["id"];
$taskRequest = "SELECT * FROM tasks WHERE id = :id";
$smtp = $pdo->prepare($taskRequest);
$smtp->bindParam(':id', $idTask);
$smtp->execute();
if ($smtp->execute()) {
    $oneTask = $smtp->fetchAll();
    if (!count($oneTask) > 0) {
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <script src="../css/bootstrap/js/bootstrap.js"></script>
    <title>Modification d'une oeuvre</title>
</head>

<body>
    <div class="container mt-5">
        <a href="./menu.php" class="btn btn-secondary mt-5" style="margin-bottom: 20px; margin-left: 0;">Retour à la liste</a>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Modifier une tâche</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../back/update.php">
                        <input hidden name="id" type="text" class="form-control" value="<?= $oneTask[0]['id'] ?>">

                        <div class="row col-md-12">
                            <div class="mb-2 col">
                                <div>
                                    <label for="description" class="col-md-3 col-form-label">Description de la tâche</label>
                                </div>

                                <div class="col">
                                    <textarea id="description" name="description" type="text" class="form-control" autofocus required></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary mt-4" value="Enregistrer">

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>