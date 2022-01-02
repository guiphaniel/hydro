<?php
    if(!isset($_POST["idMovie"])) {
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("SELECT AVG(rating) from ratings where idMovie = :idMovie"); //TODO: mettre la bonne table
    $sql->execute([
        "idMovie" => $_POST["idMovie"]
    ]);

    $rating = $sql->fetch();
    exit($rating);