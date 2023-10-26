<?php

include '../configuration/connexion.inc.php';


if (isset($_POST['id'])) {
    if (!empty($_POST['id'])) {
        $id = htmlspecialchars(strip_tags($_POST['id']));

        $getTaskRequest = "SELECT * FROM tasks WHERE id = :id";
        $smtp = $pdo->prepare($getTaskRequest);
        $smtp->bindParam(':id', $id);
        $smtp->execute();
        $task = $smtp->fetchAll();


        $oneTask = $task[0]['isCompleted'] == 1 ? 0 : 1;


        $updateTaskRequest = "UPDATE tasks SET         
            isCompleted = :isCompleted
            WHERE id = :id;
        ";
        $smtp = $pdo->prepare($updateTaskRequest);
        $smtp->bindParam(':id', $id);
        $smtp->bindParam(':isCompleted', $oneTask);
        $smtp->execute();
    } else {
        var_dump('champ vide');
    }
} else {
    var_dump('champ non défini');
}
