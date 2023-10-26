<?php
include '../configuration/connexion.inc.php';

// Get all equipe
$tasksRequest = "SELECT * FROM tasks ORDER BY created_at DESC";
$tasksList = $pdo->query($tasksRequest);
$tasks = $tasksList->fetchAll();

$isActive = 'false';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
    <script src="../css/bootstrap/js/bootstrap.js"></script>
    <title>TODO</title>
</head>

<body>
    <div class="container mt-2">
        <div class="d-flex justify-content-between">
            <a href="./search.php" class="btn btn-warning mt-3" style="margin-bottom: 20px; margin-left: 0;">Rechercher</a>
        </div>
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Ajouter une tache</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../back/store.php">

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

                        <input type="submit" class="btn btn-primary mt-4" value="Enregistrer">

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="col-md-12 shadow p-3 bg-body rounded">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Check</th>
                        <th scope="col">Description</th>
                        <th scope="col">Créée le</th>
                        <th scope="col" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tasks && count($tasks) > 0) : ?>
                        <?php foreach ($tasks as $task) : ?>
                            <tr>
                                <td>
                                    <form action="" method="post">
                                        <div class="form-check">
                                            <input class="form-check-input check" type="checkbox" value="<?= $task['id'] ?>" <?= $task['isCompleted'] ? 'checked' : '' ?>>
                                            <!-- <input type="submit" value="" hidden> -->
                                        </div>
                                    </form>
                                </td>
                                <td class="<?= ($task['isCompleted']) ? 'text-decoration-line-through' : '' ?>"><?= $task['description'] ?></td>
                                <td><?= $task['created_at'] ?></td>
                                <td>
                                    <a class="btn btn-secondary" href="./edit.php?id=<?= $task['id'] ?>">
                                        Modifier
                                    </a>
                                    <form action="../back/delete.php" method="post" style="display: inline-block;" class="form2">
                                        <input hidden name="id" type="text" class="form-control" value="<?= $task['id'] ?>">
                                        <button class="btn btn-danger" type="submit">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <th colspan="10" class="text-center">
                                Aucune tâche disponible
                            </th>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    const checkForm = document.getElementsByClassName('check');
    let form2 = document.getElementsByClassName('form2');

    for (let i = 0; i < checkForm.length; i++) {
        checkForm[i].addEventListener('input', (e) => {
            let element = checkForm[i];
            console.log(element.value);
            fetch('../back/updateCheck.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        id: element.value
                    })
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    location.reload();
                    alert('Tache mise à jour');
                })
                .catch(error => console.error(error));
        });
    }


    console.log(form2);
    for (let i = 0; i < form2.length; i++) {
        const element = form2[i];
        element.addEventListener('submit', (e) => {
            if (!confirm('Voulez-vous supprimer une tache ?')) {
                e.preventDefault();
                return false;
            }
        });
    }
</script>

</html>