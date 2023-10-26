<?php
include '../../configuration/connexion.inc.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        // Vérifier si l'utilisateur existe déjà (user avec même email dans la base de données)
        $loginRequest = "SELECT * FROM users WHERE email = :email";
        $smtp = $pdo->prepare($loginRequest);
        $smtp->bindParam(':email', $email);
        $smtp->execute();
        $user = $smtp->fetchAll();

        if (count($user) === 0) {
            echo "
                <script>
                alert('Identifiant incorrecte');
                window.location.href='../../views/auth/login.php';
                </script>
            ";
            // header("location: ../views/index.php");
        } else {
            if (password_verify($password, $user[0]['password'])) {
                session_start();
                $_SESSION['isConnected'] = true;
                header("location: ../../views/menu.php");
            } else {
                echo "
                <script>
                alert('Mauvais identifiant');
                window.location.href='../../views/auth/login.php';
                </script>
            ";
            }
            exit();
        }
    } else {
        echo "
                <script>
                alert('Champs vide');
                window.location.href='../../views/auth/login.php';
                </script>
            ";
    }
} else {
    echo "
                <script>
                alert('Champs non défini');
                window.location.href='../../views/auth/login.php';
                </script>
            ";
}
