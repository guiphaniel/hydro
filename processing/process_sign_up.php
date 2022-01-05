<?php
    session_start();
    try{
        $pdo = new PDO('sqlite:'.__DIR__.'/../database.db'); 
    } catch(PDOException $e){
        echo 'Connexion échouée : '.$e->getMessage();
        die();
    }
    if(empty($_POST['email'])||empty($_POST['username'])||empty($_POST['password'])||empty($_POST['checkPassword'])){
        
        $_SESSION['errorSignUp']="Un des champs est vide";
        header("location: ../index.php");
    }
    else if(!($_POST['password']===$_POST['checkPassword'])){
        $_SESSION['errorSignUp']="Les mots de passe sont différents";
        header("location: ../index.php");
    }
    else{
        $testEmailsql ="SELECT * FROM users WHERE email = :email";
        try {
            $count=$pdo->prepare($testEmailsql);
            $count->execute([
                'email'=> $_POST['email']
            ]);
            $user=$count->fetch();
        } catch (PDOException $Exception) {
            echo $Exception->getMessage( ) . ' code erreur : ' . $Exception->getCode( );
            
        }
        if($user){
            $_SESSION['errorSignUp']="L'adresse mail exite déjà";
            header("location: ../index.php");
            die();
        } 
        $sql= "INSERT INTO users(email,username,password) VALUES(:mail,:username,:password)";
        try{
            $statement=$pdo->prepare($sql);
            $statement->execute([
                'mail' => $_POST['email'],
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);
            $_SESSION['errorSignIn']="Vous pouvez maintenant vous connecter";
            header("location: ../index.php");
            die();
        }
        catch(PDOException $Exception){
            echo $Exception->getMessage( ) . ' code erreur : ' . $Exception->getCode( );
            
        }
    }