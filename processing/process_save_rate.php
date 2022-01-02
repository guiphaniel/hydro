<?php
    if(!(isset($_POST["idUser"]) && isset($_POST["idMovie"]) && isset($_POST["rating"]))) {
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    //verification anti-hack
    $sql = $pdo->prepare("SELECT * from movies where idMovie = :id");
    $sql->execute([
        "id" => $_POST["idMovie"]
    ]);
    $movie = $sql->fetch();

    if($_POST["idUser"] != $_SESSION['user']['id'] || !$movie || $_POST["rating"] < 0 || $_POST["rating"] > 5) {
        header("location: ../catalogue.php");
        exit();
    }

    //sauvegarde dans la bd
    $sql = $pdo->prepare("INSERT INTO ratings values (:idUser, :idMovie, :rating, :timestamp)"); //TODO: mettre la bonne table
    $sql->execute([
        "idUser" => $_POST["idUser"],
        "idMovie" => $_POST["idMovie"],
        "rating" => number_format($_POST["rating"], 1),
        "timestamp" => time(),
    ]);

    exit($rating);

    
    