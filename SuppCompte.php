<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if(!isset($_GET['id'])) die("ID compte manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM comptes WHERE id=:id");
$stmt->execute([':id'=>$id]);
header("Location: comptes.php");
?>