<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Catalogue</title>
    <script src="js/script.js"></script>
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

                    $sql = $pdo->prepare("SELECT * from userRecommendations where idUser = 2"); //TODO: mettre le vrai idUser, recupere sur la session
                    $sql->execute();
                    $sql->setFetchMode(PDO::FETCH_NUM);
                
                    foreach($sql->fetch() as $col => $movieId):
                        if ($col == 0)  //la premiere colonne correspond à l'id de l'utilisateur
                            continue;
                        $sql = $pdo->prepare("SELECT title, year, genres from movies where idMovie = $movieId limit 1");
                        $sql->execute();
                        $sql->setFetchMode(PDO::FETCH_DEFAULT);
                        $result = $sql->fetch();
                        $movieTitle = $result['title'];
                        $movieYear = $result['year'];
                        $movieGenres = $result['genres'];
                        ?>
                            <figure id="movie<?=$movieId?>" class="movie-tile" onclick="showFilmDetails('<?=$movieTitle?>', '<?=$movieYear?>', '<?=$movieGenres?>')">
                                <img src="img/default-illustration.jpg" alt="<?=$movieTitle?>">
                                <figcaption><?=$movieTitle?> <br> <?=$movieYear?></figcaption>
                            </figure>   
                            <script>showMovie("movie<?=$movieId?>", "<?=$movieTitle?>", "<?=$movieYear?>");</script>                                                   
                        <?php
                    endforeach;
                ?>
                <div id="movie-details-container" class="movie-details-container">
                    <div id="movie-details-background" onclick="closeFilmDetails()"></div>
                    <section id="movie-details-content">
                        <span class="close" onclick="closeFilmDetails()">&times;</span>
                        <div id="movie-details">
                            <div id="movie">                                
                                <img src="img/default-illustration.jpg" alt="default-illustration">
                                <div id="start-button"></div>
                            </div>
                            <div id="details">
                                <h2 class="movie-title">Titre</h2>
                                <h2 class="movie-year">Année</h2>
                                <div id="stars">
                                    <svg id="star-1" onclick="checkStar('star-1')" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                    <svg id="star-2" onclick="checkStar('star-2')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                    <svg id="star-3" onclick="checkStar('star-3')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                    <svg id="star-4" onclick="checkStar('star-4')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                    <svg id="star-5" onclick="checkStar('star-5')"aria-hidden="true" focusable="false" data-prefix="fad" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="star"><g class="fa-group"><path fill="currentColor" d="M528.53 171.5l-146.36-21.3-65.43-132.39c-11.71-23.59-45.68-23.89-57.48 0L193.83 150.2 47.47 171.5c-26.27 3.79-36.79 36.08-17.75 54.58l105.91 103-25 145.49c-4.52 26.3 23.22 46 46.48 33.69L288 439.56l130.93 68.69c23.26 12.21 51-7.39 46.48-33.69l-25-145.49 105.91-103c19-18.49 8.48-50.78-17.79-54.57zm-90.89 71l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-outer"></path><path fill="currentColor" d="M437.64 242.46l-66.05 64.23 15.63 90.86a12 12 0 0 1-17.4 12.66L288 367.27l-81.82 42.94a12 12 0 0 1-17.4-12.66l15.63-90.86-66-64.23A12 12 0 0 1 145 222l91.34-13.28 40.9-82.81a12 12 0 0 1 21.52 0l40.9 82.81L431 222a12 12 0 0 1 6.64 20.46z" class="star-inner"></path></g></svg>
                                </div>
                                <p>Description</p>
                                <p id="genres">Genres</p>
                                <div id="actors">
        
                                </div>
                            </div>
                        </div>
                        <div id="movie-recommendations">

                        </div> 
                    </section>
                </div>                        
            </section>            
        </div>
    </main>   
    <?php include "./modules/footer.php" ?>
</body>
</html>


