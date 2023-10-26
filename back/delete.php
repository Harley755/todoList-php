<?php
include '../configuration/connexion.inc.php';

// isset($_POST['id']) cet id est un champ id du fichier edit; je le récupère pour la requête
if (isset($_POST['id'])) {
    if (!empty($_POST['id'])) {
        $id = htmlspecialchars(strip_tags($_POST['id']));

        $deleteTasksRequest = "DELETE FROM tasks
            WHERE id = :id;
        ";
        $smtp = $pdo->prepare($deleteTasksRequest);
        $smtp->bindParam(':id', $id);

        if ($smtp->execute()) {
            echo "
                <script>
                alert('Tâche supprimée avec succès');
                window.location.href='../views/index.php';
                </script>
            ";
        }
    }
} else {
    echo "
        <script>
        alert('L'id n'est pas défini);
        window.location.href='../views/index.php';
        </script>
    ";
}
