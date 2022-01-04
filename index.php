<?php 
    session_start();
    if(isset($_SESSION['user'])) {
        header("Location: catalogue.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-signin-client_id" content="7221840242-8dp6ko4h3o24ut7it8fnqagip6ku3oet.apps.googleusercontent.com">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydro - Accueil</title>
</head>
<body>
    <?php include "./modules/header.php" ?>



    <section class="main-image" id="first-section">
        <h1>Regardez des films avec Hydro</h1>
    </section>
    <section class="main-image" id="second-section">
        
        <h2>Des centaines de films séléctionnés pour vous</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla suscipit, leo quis vehicula pulvinar, nulla nisi lacinia massa, eu iaculis magna metus sit amet felis. Integer quam ligula, gravida a mollis eu, mattis non arcu. Etiam sollicitudin velit felis, id tincidunt massa porttitor eu. Donec in nunc velit. Nulla accumsan tristique purus, eget scelerisque eros consequat quis. Suspendisse fermentum laoreet felis, in tempus justo rutrum rutrum. Nunc ac magna laoreet, scelerisque diam ac, maximus tellus. Curabitur ipsum quam, bibendum nec libero at, vulputate efficitur dui. <br>

Nunc interdum bibendum imperdiet. Nam quis porta ligula. Donec pulvinar nisi eget arcu maximus tempor. Quisque eget tellus eget lorem bibendum malesuada ultricies quis risus. Phasellus lacus sem, tincidunt nec felis at, elementum imperdiet odio. Vestibulum laoreet fermentum felis id convallis. Sed faucibus eros ac nunc tristique, quis euismod ex commodo. Fusce ac dolor sit amet dui maximus faucibus. Cras at fermentum diam. Etiam sagittis aliquam sodales. Praesent at varius sem, nec elementum diam. Nunc quam nulla, consectetur a orci non, mattis convallis turpis. Fusce a aliquam risus, id tristique magna. Aenean mattis libero in magna consequat condimentum. Fusce a justo vestibulum, imperdiet nunc et, cursus felis.<br>

Quisque commodo ullamcorper nunc, et viverra massa volutpat tincidunt. Phasellus sagittis eros a est consectetur venenatis. Aliquam sodales nisi leo, at accumsan justo pretium eu. Aenean congue purus ac nisi finibus, nec aliquam dui porttitor. Etiam id congue ex, a porttitor dolor. Nullam maximus nulla consectetur vulputate sodales. Maecenas dolor mi, consectetur vel urna sed, semper venenatis libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam gravida nisi eget luctus blandit. Duis interdum mollis elit, vitae sagittis neque vehicula in. Sed pretium ac nibh ac tempus. Sed rhoncus at erat a rhoncus. Maecenas tellus velit, varius non mattis a, molestie in urna.<br>

Nulla finibus lobortis nulla a consectetur. Phasellus ut bibendum sem. In commodo sem sit amet purus commodo, in aliquet elit vehicula. Donec tempor lobortis maximus. Cras eget sem facilisis, cursus massa ac, dignissim eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam ut sodales magna. Duis dapibus et justo ac dictum.<br>

Donec quis purus tristique, interdum velit sed, imperdiet tellus. Ut fermentum id nibh eu varius. Sed augue neque, ultricies sed laoreet vitae, viverra non turpis. In scelerisque, lacus eget elementum pellentesque, justo libero ullamcorper urna, ut feugiat sapien augue ut ipsum. In sed arcu vel mi volutpat viverra. Nulla ultrices lorem ligula, vel scelerisque mauris scelerisque eget. Phasellus suscipit lorem sapien, ac auctor magna vestibulum et.</p>
    </section>
    <section class="main-image" id="third-section">
        <h2>Un accès partout, tout le temps</h2>
        
    </section>
    <?php include "./modules/footer.php" ?>

    
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>