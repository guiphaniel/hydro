<?php
    if(!(isset($_POST["idUser"]) && isset($_POST["isMovie"]) && isset($_POST["rating"]))) {
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("INSERT INTO ratings values (:idUser, :idMovie, :rating, :timestamp)"); //TODO: mettre la bonne table
    $sql->execute([
        "idUser" => $_POST["idUser"],
        "idMovie" => $_POST["idMovie"],
        "rating" => $_POST["rating"],
        "timestamp" => time(),
    ]);

    exit($rating);

    
    