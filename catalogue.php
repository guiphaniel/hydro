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
                <figure id="movie1" class="movie-tile" onclick="showFilmDetails('movie1')">
                    <img src="img/star-wars.jpg" alt="Movie Name">
                    <figcaption>Movie Name <br> Date</figcaption>
                </figure>
                <div id="movie1-details-container" class="movie-details-container">
                    <div class="movie-details-background" onclick="showFilmDetails('movie1')"></div>
                    <section class="movie-details">

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


