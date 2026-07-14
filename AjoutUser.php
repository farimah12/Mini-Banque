<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, login, password) VALUES (:nom,:login,:password)");
    $stmt->execute([':nom'=>$nom, ':login'=>$login, ':password'=>$password]);
    header("Location: user.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5" style="max-width:500px;">
    <h2>Ajouter un utilisateur</h2>
    <form method="post">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Login</label>
            <input type="text" name="login" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-purple">Ajouter</button>
    </form>
</div>
<?php include "footer.php"; ?>
</body>
</html>