<?php
//session_start();
if(!isset($_SESSION['user'])) header("Location:index.php?page=connexion");
include "db.php";

$usersCount = $pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
$clientsCount = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$accountsCount = $pdo->query("SELECT COUNT(*) FROM comptes")->fetchColumn();
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
    <div class="container mt-5">
<h2>Tableau de bord</h2>
<div class="row mt-4">
<?php $data=[['Utilisateurs',$usersCount,'utilisateurs'],['Clients',$clientsCount,'clients'],['Comptes',$accountsCount,'comptes']]; ?>
<?php foreach($data as $d): ?>
<div class="col-md-4">
    <div class="card text-white bg-purple mb-3">
        <div class="card-body">
            <h5 class="card-title"><?=$d[0];?></h5>
            <p class="card-text"><?=$d[1];?></p>
            <a href="index.php?page=<?=$d[2];?>" class="btn btn-light">Gérer</a>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>
<?php include "footer.php"; ?>
</body>
</html>