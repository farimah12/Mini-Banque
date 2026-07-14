<?php
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page){
    case 'home': include "home.php"; break;
    case 'connexion': include "Connexion.php"; break;
    case 'TabDeBord': include "TabDeBord.php"; break;
    case 'utilisateurs': include "user.php"; break;
    case 'clients': include "Clients.php"; break;
    case 'comptes': include "comptes.php"; break;
    case 'transaction': include "TransactionCompte.php"; break;
    default: echo "<h2>Page non trouvée</h2>"; break;
}
?>