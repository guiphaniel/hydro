<?php
    session_start();

    if(!isset($_POST["idMovie"])) {
        http_response_code(406);
        header("location: ../catalogue.php");
        exit();
    }

    include "../include/start-db.php";

    $sql = $pdo->prepare("SELECT rating from ratings where idUser = :idUser and idMovie = :idMovie");
    $sql->execute([
        "idUser" => $_SESSION['user']['id'],
        "idMovie" => $_POST["idMovie"]
    ]);
    $sql->setFetchMode(PDO::FETCH_NUM);
    $rating = $sql->fetch();
    
    exit($rating[0]);