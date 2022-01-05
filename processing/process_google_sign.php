<?php
    session_start();
    
    try{
        $pdo = new PDO('sqlite:'.__DIR__.'/../database.db'); 
    } catch(PDOException $e){
        echo 'Connexion échouée : '.$e->getMessage();

    }
    if(empty($_POST)||empty(['idtoken'])){
        header("location: ../index.php");
        exit();
    }
    $json = file_get_contents('https://oauth2.googleapis.com/tokeninfo?id_token='.$_POST['idtoken']);
    
    // decode the json data
    $payload = json_decode($json, true);
    
    $userid= $payload['sub'];
    



    //check if the account already exist
    $stringToken = $pdo->quote($userid);
    $sql= "SELECT * FROM googleUsers WHERE token = $stringToken";
    try{
        $count=$pdo->query($sql);
        $user=$count->fetch();
    }
    catch(PDOException $Exception){
        echo 'erreur lors de l acces à la bd';
    }
    if(empty($user)){
        echo 'user vide';
        try{

            
            $sql= "INSERT INTO users(email,username) VALUES(:mail,:username)";
            $statement=$pdo->prepare($sql);
            $statement->execute([
                'mail' => $payload['email'],
                'username' => $payload['name']
                
            ]);
            
            $testEmailsql ="SELECT * FROM users WHERE email = :email";
            $count=$pdo->prepare($testEmailsql);
            $count->execute([
                'email'=> $payload['email']
            ]);
            $user=$count->fetch();
            
            $sql= "INSERT INTO googleUsers(token,idUser) VALUES(:token,:id)";
            $statement=$pdo->prepare($sql);
            $statement->execute([
                'token' => $userid,
                'id' => $user['id']
            ]);

            $_SESSION['user']['id']=$user['id'];
            $_SESSION['user']['username']=$user['username'];
            echo 'account logged succesfully';
            
            
        }
        catch(PDOException $Exception){
            echo $Exception->getMessage( ) . ' code erreur : ' . $Exception->getCode( );
            
        }
        exit();
    }
    else{
        echo 'user connu';
        $testEmailsql ="SELECT * FROM users WHERE email = :email";
        $count=$pdo->prepare($testEmailsql);
        $count->execute([
            'email'=> $payload['email']
        ]);
        $user=$count->fetch();
        $_SESSION['user']['id']=$user['id'];
        $_SESSION['user']['username']=$user['username'];
    }

    
?>
