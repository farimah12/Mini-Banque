<?php
//session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

$comptes = $pdo->query("
    SELECT comptes.id, comptes.numero, comptes.solde, clients.nom, clients.prenom
    FROM comptes
    LEFT JOIN clients ON comptes.client_id = clients.id
    ORDER BY comptes.id ASC
")->fetchAll(PDO::FETCH_ASSOC);
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
    <h2>Liste des comptes</h2>
    <a href="AjoutCompte.php" class="btn btn-purple mb-3">Ajouter un compte</a>
    <table class="table table-bordered table-striped">
        <thead class="bg-purple text-white">
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Solde</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($comptes as $c): ?>
            <tr>
                <td><?= $c['id']; ?></td>
                <td><?= $c['numero']; ?></td>
                <td><?= $c['nom']." ".$c['prenom']; ?></td>
                <td><?= number_format($c['solde'],2,","," "); ?> CFA</td>
                <td>
                    <a href="ModifCompte.php?id=<?= $c['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="SuppCompte.php?id=<?= $c['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    <a href="TransactionCompte.php?id=<?= $c['id']; ?>" class="btn btn-purple btn-sm">Transaction</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "footer.php"; ?>
</body>
</html>