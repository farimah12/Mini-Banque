<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if(!isset($_GET['id'])) die("ID compte manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM comptes WHERE id=:id");
$stmt->execute([':id'=>$id]);
$compte = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$compte) die("Compte non trouvé");

$clients = $pdo->query("SELECT * FROM clients ORDER BY nom ASC")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']==='POST'){
    $numero = $_POST['numero'];
    $client_id = $_POST['client_id'];
    $solde = floatval($_POST['solde']);
    if($solde < 0) $solde = 0;

    $stmt = $pdo->prepare("UPDATE comptes SET numero=:numero, client_id=:client_id, solde=:solde WHERE id=:id");
    $stmt->execute([':numero'=>$numero, ':client_id'=>$client_id, ':solde'=>$solde, ':id'=>$id]);
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
    <h2>Modifier un compte</h2>
    <form method="post">
        <div class="mb-3"><label>Numéro</label><input type="text" name="numero" class="form-control" value="<?= $compte['numero']; ?>" required></div>
        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                <?php foreach($clients as $cl): ?>
                <option value="<?= $cl['id']; ?>" <?= $cl['id']==$compte['client_id']?'selected':''; ?>><?= $cl['nom']." ".$cl['prenom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label>Solde</label><input type="number" name="solde" class="form-control" step="0.01" min="0" value="<?= $compte['solde']; ?>" required></div>
        <button type="submit" class="btn btn-purple">Modifier</button>
    </form>
</div>
<?php include "footer.php"; ?>
</body>
</html>