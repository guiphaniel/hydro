<?php
    if(!(isset($_POST["idMovie"]) && isset($_POST["rating"]))) {
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
        exit();
    }

    //sauvegarde dans la bd
    $sql = $pdo->prepare("INSERT INTO ratings values (:idUser, :idMovie, :rating, :timestamp)"); //TODO: mettre la bonne table
    $sql->execute([
        "idUser" => $_SESSION['user']['id'],
        "idMovie" => $_POST["idMovie"],
        "rating" => number_format($_POST["rating"], 1),
        "timestamp" => time(),
    ]);

    exit($rating);

    
    