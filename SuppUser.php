<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: index.php?page=connexion");
include "db.php";

if(!isset($_GET['id'])) die("ID utilisateur manquant");
$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id=:id");
$stmt->execute([':id'=>$id]);
header("Location: user.php");
?>