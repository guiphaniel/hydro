<?php
    session_start();
    try{
        $pdo = new PDO('sqlite:'.__DIR__.'/../database.db'); 
    } catch(PDOException $e){
        echo 'Connexion échouée : '.$e->getMessage();

    }
    if(empty($_POST['username'])||empty($_POST['password'])){
        $_SESSION['errorSignIn']="Un des champs est manquant";
        header("location: ../index.php");    
        exit();
    }
    $stringUser = $pdo->quote($_POST['username']);
    $sql= "SELECT * FROM users WHERE username = $stringUser OR email=$stringUser";
    try{
        $count=$pdo->query($sql);
        $user=$count->fetch();
        
    }
    catch(PDOException $Exception){
        $_SESSION['errorSignIn']="Le mot de passe ou l'identifiant n'est pas reconnu";
        header("location: ../index.php");
        exit();
    }
    if($user&& password_verify($_POST['password'],$user['password'])){
        $_SESSION['user']['id']=$user['id'];
        $_SESSION['user']['username']=$user['username'];
        header("location: ../catalogue.php");
        exit();
        
    }
    else{
        $_SESSION['errorSignIn']="Le mot de passe ou l'identifiant n'est pas reconnu";
        header("location: ../index.php");
        exit();

    }