<header>
    <input type="checkbox" id="menu-toogle" for="toogle"/>
    <img id="logo-with-text" for="toogle" src="./img/LogoSombreTexte.png" alt="logo Hydro with text">
    <img id="logo-without-text" for="toogle" src="./img/LogoSombre.svg" alt="logo Hydro">

    <ul id="menu"class="accountButtons">
        <li><a href="./header.php"><button class="inscription">Inscription</button></a></li>
        <li><button id="connexion" class="connexion">Connexion</button></li>
    </ul>

    <div id="modalConnexion" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="autoLog">
                <button>Se connecter avec Google</button>
                <button>Se connecter avec Facebook</button>
            </div>
            <div class="hl"></div>
            <form action="" method="post">
                <label for="idUser">Identifiant</label>
                <input type="text" name="idUser" id="idUser">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
                <button class="connexion" type="submit">Connexion</button>
            </form>
        </div>

    </div>
    <script src="../js/script.js"></script>


</header>