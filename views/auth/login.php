<?php

session_start();
if ($_SESSION ? $_SESSION['isConnected'] : false) {
    header("location: ../menu.php");
    exit();
}

$error = "";
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.css">
    <script src="../../css/bootstrap/js/bootstrap.js"></script>
    <title>Connexion</title>
</head>

<body>
    <!-- <div class="container mt-3" id="errorDiv">
        <div class="alert alert-danger alert-block d-flex justify-content-between">
            <ul class="list-unstyled">
                <li id="errorList"><?= $error  ?></li>
            </ul>
            <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
    </div> -->

    <div class="container d-flex justify-content-center mt-5">
        <div class="col-md-6 shadow p-3 bg-body rounded">
            <div class="card">
                <div class="card-header">
                    <h5>Connexion</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="../../back/auth/login.php" id="connexion">
                        <div class="mb-2 col">
                            <div>
                                <label for="email" class="col-md-3 col-form-label">Email</label>
                            </div>

                            <div class="col">
                                <input id="email" name="email" type="email" class="form-control" autofocus>
                            </div>
                            <!-- <span class="help-block text-danger" id="idError"></span> -->
                        </div>
                        <div class="mb-2 col">
                            <div>
                                <label for="password" class="col-md-3 col-form-label">Mot de passe</label>
                            </div>

                            <div class="col">
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                            <!-- <span class="help-block text-danger" id="mdpError"></span> -->
                        </div>


                        <div class="d-flex align-items-md-baseline justify-content-between">
                            <input type="submit" class="btn btn-primary mt-4" value="Connecter">
                            <p>Vous n'avez pas un compte ? <a href="./register.php">Inscrivez-vous !</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/validationConnexion.js"></script>
</body>

</html>