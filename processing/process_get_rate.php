<?php
    if(!isset($_POST["id"])) {
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("SELECT AVG(rating) from ratings where idMovie = :id"); //TODO: mettre la bonne table
    $sql->execute([
        "id" => $_POST["id"]
    ]);

    $rating = $sql->fetch();
    exit($rating);