<?php
    session_start();

    if(!(isset($_POST["idMovie"]) && isset($_POST["rating"]))) {
        http_response_code(406);
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    //verification anti-hack
    $sql = $pdo->prepare("SELECT * from movies where idMovie = :id"); //on verifie l'existence du film
    $sql->execute([
        "id" => $_POST["idMovie"]
    ]);
    $movie = $sql->fetch();

    if(!$movie || $_POST["rating"] < 0 || $_POST["rating"] > 5) {
        header("location: ../catalogue.php");
        http_response_code(406);
        exit();
    }

    //sauvegarde dans la bd
    //on verifie si l'utilisateur a deja note ce film
    $sql = $pdo->prepare("SELECT * from ratings where idUser = :idUser and idMovie = :idMovie");
    $sql->execute([
        "idUser" => $_SESSION['user']['id'],
        "idMovie" => $_POST["idMovie"]
    ]);
    $entry = $sql->fetch();

    if($entry) { //si c'est le cas, on remplace la note existente
        $sql = $pdo->prepare("UPDATE ratings SET rating = :rating, timestamp = :timestamp where idUser = :idUser and idMovie = :idMovie"); 
        $sql->execute([
            "idUser" => $_SESSION['user']['id'],
            "idMovie" => $_POST["idMovie"],
            "rating" => number_format($_POST["rating"], 1),
            "timestamp" => time(),
        ]);
    } else { //sinon, on l'ajoute
        $sql = $pdo->prepare("INSERT INTO ratings values (:idUser, :idMovie, :rating, :timestamp)"); 
        $sql->execute([
            "idUser" => $_SESSION['user']['id'],
            "idMovie" => $_POST["idMovie"],
            "rating" => number_format($_POST["rating"], 1),
            "timestamp" => time(),
        ]);
    }


    
    
    