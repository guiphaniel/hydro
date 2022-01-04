<header>
    
    
        <input type="checkbox" id="menu-toogle" for="toogle"/>
        <a href="./index.php"><img id="logo-with-text" for="toogle" src="./img/LogoSombreTexte.png" alt="logo Hydro with text"></a>
        <img id="logo-without-text" for="toogle" src="./img/LogoSombre.svg" alt="logo Hydro">
        
        <?php
            if(isset($_SESSION['user'])):
        ?>

        <form id="search-bar-container" action="search.php" method="get">
            <input type="text" name="movie" id="search-bar" placeholder="Rechercher">
            <button class="button" id="rechercher" type="submit">Rechercher</button>
        </form>

        <?php
            endif;
        ?>
    
    

    <ul id="menu"class="accountButtons">        
        <?php 
        if(empty($_SESSION['user'])){
            echo '<li><div id= "signUpBtn"class="button" onclick="show(modalSignUp)">Inscription</div></li>';
            echo '<li><div id="signInBtn" class="button" onclick="show(modalSignIn)">Connexion</div></li>';
        }
        else{
            echo '<li><div  id= "signOutBtn" class="button" onclick="location.href = \'./processing/process_sign_out.php\';" onclick="signOut();">Deconnexion</div></li>';
        }
        ?>
        
    </ul>
    <?php include "./modules/sign_in.php" ;
    include "./modules/sign_up.php"?>
    
    <script src="../js/script.js"></script>


</header>