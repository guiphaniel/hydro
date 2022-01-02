<?php
    if(!(isset($_POST["idUser"]) && isset($_POST["isMovie"]) && isset($_POST["rate"]))) {
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("INSERT INTO ratings values (:idUser, :idMovie, :rate, :timestamp)"); //TODO: mettre la bonne table
    $sql->execute([
        "idUser" => $_POST["idUser"],
        "idMovie" => $_POST["idMovie"],
        "rate" => $_POST["rate"],
        "timestamp" => time(),
    ]);

    exit($rate);

    
    