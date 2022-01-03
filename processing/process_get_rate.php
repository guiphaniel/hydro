<?php
    if(!isset($_POST["idMovie"])) {
        http_response_code(406);
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("SELECT AVG(rating) from ratings where idMovie = :idMovie");
    $sql->execute([
        "idMovie" => $_POST["idMovie"]
    ]);
    $sql->setFetchMode(PDO::FETCH_NUM);
    $rating = $sql->fetch();
    
    exit($rating[0]);