<?php
include '../../configuration/connexion.inc.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $password = password_hash(htmlspecialchars(strip_tags($_POST['password'])), PASSWORD_DEFAULT);

        // Vérifier si l'utilisateur existe déjà (user avec même email dans la base de données)
        $vericationRequest = "SELECT * FROM users WHERE email = :email";
        $verificationSmtp = $pdo->prepare($vericationRequest);
        $verificationSmtp->bindParam(':email', $email);
        $verificationSmtp->execute();

        if (count($verificationSmtp->fetchAll()) > 0) {
            // L'UTILISATEUR EXISTE
            echo "
                <script>
                alert('L'utilisateur existe déjà');
                window.location.href='../../views/auth/register.php';
                </script>
            ";
        } else {
            // L'UTILISATEUR N'EXISTE PAS (Donc on le cré)
            $connexionRequest = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $smtp = $pdo->prepare($connexionRequest);
            $smtp->bindParam(':name', $name);
            $smtp->bindParam(':email', $email);
            $smtp->bindParam(':password', $password);
            // $smtp->execute();
            if ($smtp->execute()) {
                echo "
                <script>
                alert('Utilisateur inscrit avec succès !');
                window.location.href='../../views/auth/login.php';
                </script>
            ";
                // header("location: ../views/index.php");
            } else {
                echo "
                <script>
                alert('Une erreur s'est produite');
                window.location.href='../../views/auth/register.php';
                </script>
            ";
            }
        }
    } else {
        echo "
                <script>
                alert('Champs vide');
                window.location.href='../../views/auth/register.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Champs non définis');
                window.location.href='../../views/auth/register.php';
                </script>
            ";
}
