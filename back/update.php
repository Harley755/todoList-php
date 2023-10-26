<?php

include '../configuration/connexion.inc.php';


if (isset($_POST['id']) && isset($_POST['description'])) {
    if (!empty($_POST['id']) && !empty($_POST['description'])) {
        $id = htmlspecialchars(strip_tags($_POST['id']));
        $description = htmlspecialchars(strip_tags($_POST['description']));

        $updateTaskRequest = "UPDATE tasks SET         
            description = :description,
            updated_at = NOW()
            WHERE id = :id;
        ";
        $smtp = $pdo->prepare($updateTaskRequest);
        $smtp->bindParam(':id', $id);
        $smtp->bindParam(':description', $description);

        if ($smtp->execute()) {
            echo "
                <script>
                alert('Tache mise à jour avec succès !');
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
