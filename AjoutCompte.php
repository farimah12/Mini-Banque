<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

$clients = $pdo->query("SELECT * FROM clients ORDER BY nom ASC")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']==='POST'){
    $numero = $_POST['numero'];
    $client_id = $_POST['client_id'];
    $solde = floatval($_POST['solde']);
    if($solde < 0) $solde = 0;

    $stmt = $pdo->prepare("INSERT INTO comptes (numero, client_id, solde) VALUES (:numero,:client_id,:solde)");
    $stmt->execute([':numero'=>$numero, ':client_id'=>$client_id, ':solde'=>$solde]);
    header("Location: comptes.php");
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
    <h2>Ajouter un compte</h2>
    <form method="post">
        <div class="mb-3"><label>Numéro</label><input type="text" name="numero" class="form-control" required></div>
        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                <?php foreach($clients as $cl): ?>
                <option value="<?= $cl['id']; ?>"><?= $cl['nom']." ".$cl['prenom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label>Solde initial</label><input type="number" name="solde" class="form-control" min="0" step="0.01" value="0" required></div>
        <button type="submit" class="btn btn-purple">Ajouter</button>
    </form>
</div>
<?php include "footer.php"; ?>
</body>
</html>