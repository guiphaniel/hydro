<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Catalogue</title>
</head>
<body>
    <?php include_once "modules/header.php"?>
    <main>
        <div id="content">
            <nav></nav>
            <section id="movie-tile-wrapper">
                <?php
                    $dsn = "sqlite:database.db";

                    try {    
                        $pdo = new PDO($dsn);
                    } catch (PDOException $e) {
                        echo 'Connexion échouée : ' . $e->getMessage();
                        die();
                    }

                    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

                    $sql = $pdo->prepare("SELECT * from userRecommandations where idUser = 2"); //TODO: mettre le vrai idUser, recupere sur la session
                    $sql->execute();
                    $sql->setFetchMode(PDO::FETCH_NUM);
                
                    foreach($sql->fetch() as $col => $movieId):
                        if ($col == 0) {
                            continue;
                        }
                        ?>
                        
                            <figure id="movie<?=$movieId?>" class="movie-tile" onclick="showFilmDetails('movie<?=$movieId?>')">
                                <img src="img/star-wars.jpg" alt="Movie Name">
                                <figcaption>Movie Name <br> Date</figcaption>
                            </figure>                            
                        <?php
                    endforeach;
                ?>
                <div id="movie-details-container" class="movie-details-container">
                    <div class="movie-details-background" onclick="hideFilmDetails()"></div>
                    <section class="movie-details-content">
                        <span class="close" onclick="hideFilmDetails()">&times;</span>
                        <h2>Titre</h2>
                        <div id="movie-description">
                            <img src="#" alt="">
                            <p>description</p>
                        </div>
                        <div id="actors"></div>
                    </section>
                </div>                        
            </section>

            
        </div>
    </main>
    <footer>

    </footer>
    <script src="js/script.js"></script>
</body>
</html>


