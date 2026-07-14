<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if(!isset($_GET['id'])) die("ID client manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM clients WHERE id=:id");
$stmt->execute([':id'=>$id]);
header("Location: Clients.php");
?>