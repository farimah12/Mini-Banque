<?php
//session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

$clients = $pdo->query("SELECT * FROM clients ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    <h2>Liste des clients</h2>
    <a href="AjoutClient.php" class="btn btn-purple mb-3">Ajouter un client</a>
    <table class="table table-bordered table-striped">
        <thead class="bg-purple text-white">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Âge</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clients as $c): ?>
            <tr>
                <td><?= $c['id']; ?></td>
                <td><?= $c['nom']; ?></td>
                <td><?= $c['prenom']; ?></td>
                <td><?= $c['telephone']; ?></td>
                <td><?= $c['age']; ?></td>
                <td>
                    <a href="ModifClient.php?id=<?= $c['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="SuppClient.php?id=<?= $c['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "footer.php"; ?>
</body>
</html>