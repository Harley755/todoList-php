<?php
include '../configuration/connexion.inc.php';

if (isset($_POST['idmatch']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['idequipe1']) && isset($_POST['idequipe2'])) {
    if (!empty($_POST['idmatch']) && !empty($_POST['date']) && !empty($_POST['lieu']) && isset($_POST['idequipe1']) && !empty($_POST['idequipe2'])) {
        $idmatch = htmlspecialchars(strip_tags($_POST['idmatch']));
        $date = htmlspecialchars(strip_tags($_POST['date']));
        $lieu = htmlspecialchars(strip_tags($_POST['lieu']));
        $idequipe1 = htmlspecialchars(strip_tags($_POST['idequipe1']));
        $idequipe2 = htmlspecialchars(strip_tags($_POST['idequipe2']));

        $equipes = array($idequipe1, $idequipe2);

        if ($idequipe1 != $idequipe2) {
            foreach ($equipes as $equipe) {
                $createJoueurRequest = "INSERT INTO `match` (idmatch, date, lieu, idequipe) VALUES (:idmatch, :date, :lieu, :idequipe)";
                $smtp = $pdo->prepare($createJoueurRequest);
                $smtp->bindParam(':idmatch', $idmatch, PDO::PARAM_INT);
                $smtp->bindParam(':date', $date);
                $smtp->bindParam(':lieu', $lieu);
                $smtp->bindParam(':idequipe', $equipe, PDO::PARAM_INT);
                $smtp->execute();
            }
            header("location: ../views/menu.php");
        } else {
            var_dump('Vous ne pouvez pas sélectionner deux même équipe');
        }
    }
} else {
    var_dump('Champs non défini');
}
