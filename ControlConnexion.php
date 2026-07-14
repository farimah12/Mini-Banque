<?php
session_start();
include "db.php";

if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php?page=connexion");
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login=:login AND password=:password");
    $stmt->execute([':login'=>$login, ':password'=>$password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $_SESSION['user']=$user;
        header("Location: index.php?page=TabDeBord");
    } else {
        echo "<script>alert('Login ou mot de passe incorrect'); window.location='index.php?page=connexion';</script>";
    }
}
?>