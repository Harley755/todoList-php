<?php
include '../configuration/connexion.inc.php';

if (isset($_POST['description'])) {
    if (!empty($_POST['description'])) {
        $description = htmlspecialchars(strip_tags($_POST['description']));

        $createTaskRequest = "INSERT INTO tasks (description, isCompleted, created_at) VALUES (:description, false, NOW())";

        $smtp = $pdo->prepare($createTaskRequest);
        $smtp->bindParam(':description', $description);

        if ($smtp->execute()) {
            echo "
                <script>
                alert('Tache ajoutée avec succès !');
                window.location.href='../views/index.php';
                </script>
            ";
            // header("location: ../views/index.php");
        } else {
            echo "
                <script>
                alert('Une erreur s'est produite');
                window.location.href='../views/index.php';
                </script>
            ";
        }
    } else {
        echo "
                <script>
                alert('Champs vide');
                window.location.href='../views/index.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Champs non défini');
                window.location.href='../views/index.php';
                </script>
            ";
}
