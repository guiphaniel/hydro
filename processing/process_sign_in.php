<?php
    session_start();
    try{
        $pdo = new PDO('sqlite:'.__DIR__.'/../database.db'); 
    } catch(PDOException $e){
        echo 'Connexion échouée : '.$e->getMessage();

    }
    if(empty($_POST['sign-in-username'])||empty($_POST['sign-in-password'])){
        $_SESSION['errorSignIn']="Un des champs est manquant";
        header("location: ../index.php");    
        exit();
    }
    $stringUser = $pdo->quote($_POST['sign-in-username']);
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
    
    if($user&& password_verify($_POST['sign-in-password'],$user['password'])){
        $_SESSION['user']['id']=$user['id'];
        $_SESSION['user']['username']=$user['username'];
        header("location: ../index.php");
        exit();
        
    }
    else{
        $_SESSION['errorSignIn']="Le mot de passe ou l'identifiant n'est pas reconnu";
        header("location: ../index.php");
        exit();

    }