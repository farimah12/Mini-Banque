<nav class="navbar navbar-expand-lg navbar-dark bg-purple sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?page=home">
      <i class="bi bi-bank2"></i> Mini Banque
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?page=TabDeBord"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=utilisateurs"><i class="bi bi-people"></i> Utilisateurs</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=clients"><i class="bi bi-person-vcard"></i> Clients</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=comptes"><i class="bi bi-wallet2"></i> Comptes</a></li>
          <li class="nav-item ms-lg-2">
            <span class="navbar-user"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['user']['nom']); ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-logout" href="ControlConnexion.php?logout=1"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?page=connexion"><i class="bi bi-box-arrow-in-right"></i> Connexion</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
