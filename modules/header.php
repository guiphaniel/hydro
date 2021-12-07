<header>
    <input type="checkbox" id="menu-toogle" for="toogle"/>
    <img id="logo-with-text" for="toogle" src="./img/LogoSombreTexte.png" alt="logo Hydro with text">
    <img id="logo-without-text" for="toogle" src="./img/LogoSombre.svg" alt="logo Hydro">

    <ul id="menu"class="accountButtons">
        <li><div id= "signUpBtn"class="button" onclick="show(modalSignUp)">Inscription</div></a></li>
        <li><div id="signInBtn" class="button" onclick="show(modalSignIn)">Connexion</div></li>
    </ul>
    <?php include "./modules/sign_in.php" ;
    include "./modules/sign_up.php"?>

    <script src="../js/script.js"></script>


</header>