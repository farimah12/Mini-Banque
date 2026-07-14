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
    
<div class="container mt-5">
    <h2 class="text-center">Connexion</h2>
    <form action="ControlConnexion.php" method="post" class="mx-auto" style="max-width:400px;">
        <div class="mb-3">
                <label><i class="bi bi-person"></i> Login</label>
                <input type="text" name="login" class="form-control" placeholder="Votre identifiant" required>
            </div>
            <div class="mb-4">
                <label><i class="bi bi-lock"></i> Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-purple w-100">
                <i class="bi bi-box-arrow-in-right"></i> Se connecter
            </button>
    </form>
</div>
<style>.btn-purple{background-color:#0F5257;color:#fff;}.btn-purple:hover{background-color:#0A3B40;}</style>
<?php include "footer.php"; ?>
</body>
</html>