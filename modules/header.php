<header>
    <input type="checkbox" id="menu-toogle" for="toogle"/>
    <img id="logo-with-text" for="toogle" src="./img/LogoSombreTexte.png" alt="logo Hydro with text">
    <img id="logo-without-text" for="toogle" src="./img/LogoSombre.svg" alt="logo Hydro">

    <ul id="menu"class="accountButtons">
        <li><a href="./header.php"><button class="inscription">Inscription</button></a></li>
        <li><button id="connexion" class="connexion">Connexion</button></li>
    </ul>
    <?php include "./modules/signIn.php" ?>

    <script src="../js/script.js"></script>


</header>