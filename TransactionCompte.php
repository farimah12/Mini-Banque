<?php
session_start();
if(!isset($_SESSION['user'])){ header("Location: index.php?page=connexion"); exit(); }
include "db.php";

if(!isset($_GET['id'])) die("ID compte manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT comptes.id, comptes.numero, comptes.solde, clients.nom, clients.prenom 
                       FROM comptes 
                       LEFT JOIN clients ON comptes.client_id = clients.id
                       WHERE comptes.id=:id");
$stmt->execute([':id'=>$id]);
$compte = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$compte) die("Compte non trouvé");

$message = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $type = $_POST['type'];
    $montant = floatval($_POST['montant']);

    if($montant <= 0){
        $message = "Le montant doit être supérieur à 0 !";
    } elseif($type == 'retrait' && $montant > $compte['solde']){
        $message = "Solde insuffisant pour ce retrait !";
    } else {
        if($type == 'depot'){
            $newSolde = $compte['solde'] + $montant;
        } else {
            $newSolde = $compte['solde'] - $montant;
        }
        $stmt = $pdo->prepare("UPDATE comptes SET solde=:solde WHERE id=:id");
        $stmt->execute([':solde'=>$newSolde, ':id'=>$id]);
        $message = ucfirst($type)." effectué avec succès ! Nouveau solde : ".number_format($newSolde,2,","," ")." CFA";
        $compte['solde'] = $newSolde;
    }
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
    <h2>Transactions sur le compte <?= $compte['numero']; ?></h2>
    <p>Client : <?= $compte['nom']." ".$compte['prenom']; ?></p>
    <p>Solde actuel : <?= number_format($compte['solde'],2,","," "); ?> CFA</p>

    <?php if($message!=""): ?>
        <div class="alert alert-info"><?= $message; ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label>Type de transaction</label>
            <select name="type" class="form-control" required>
                <option value="depot">Dépôt</option>
                <option value="retrait">Retrait</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Montant</label>
            <input type="number" step="0.01" name="montant" class="form-control" min="0.01" required>
        </div>
        <button type="submit" class="btn btn-purple w-100">Valider</button>
    </form>
</div>
<?php include "footer.php"; ?>
</body>
</html>