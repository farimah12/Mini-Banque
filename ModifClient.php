<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if(!isset($_GET['id'])) die("ID client manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM clients WHERE id=:id");
$stmt->execute([':id'=>$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$client) die("Client non trouvé");

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("UPDATE clients SET nom=:nom, prenom=:prenom, telephone=:telephone, age=:age WHERE id=:id");
    $stmt->execute([
        ':nom'=>$nom,
        ':prenom'=>$prenom,
        ':telephone'=>$telephone,
        ':age'=>$age,
        ':id'=>$id
    ]);
    header("Location: Clients.php");
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
    <h2>Modifier un client</h2>
    <form method="post">
        <div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" value="<?= $client['nom']; ?>" required></div>
        <div class="mb-3"><label>Prénom</label><input type="text" name="prenom" class="form-control" value="<?= $client['prenom']; ?>" required></div>
        <div class="mb-3"><label>Téléphone</label><input type="text" name="telephone" class="form-control" value="<?= $client['telephone']; ?>" required></div>
        <div class="mb-3"><label>Âge</label><input type="number" name="age" class="form-control" value="<?= $client['age']; ?>" min="0" required></div>
        <button type="submit" class="btn btn-purple">Modifier</button>
    </form>
</div>
<?php include "footer.php"; ?>
</body>
</html>