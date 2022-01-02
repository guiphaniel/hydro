<header>
    
    <input type="checkbox" id="menu-toogle" for="toogle"/>
    <a href="./index.php"><img id="logo-with-text" for="toogle" src="./img/LogoSombreTexte.png" alt="logo Hydro with text"></a>
    <img id="logo-without-text" for="toogle" src="./img/LogoSombre.svg" alt="logo Hydro">
    
    <ul id="menu"class="accountButtons">
        <li><div id= "homeBtn" class="button" onclick="location.href ='./index.php'">Acceuil</div></li>
        
        <?php 
        if(empty($_SESSION['user'])){
            echo '<li><div id= "signUpBtn"class="button" onclick="show(modalSignUp)">Inscription</div></li>';
            echo '<li><div id="signInBtn" class="button" onclick="show(modalSignIn)">Connexion</div></li>';
        }
        else{
            echo '<li><div id= "catalogueBtn" class="button" onclick="location.href =\'./catalogue.php\'">Catalogue</div></li>';
            echo '<li><div  id= "signOutBtn" class="button" onclick="location.href = \'./processing/process_sign_out.php\';" onclick="signOut();">Deconnexion</div></li>';
        }
        ?>
        
    </ul>
    <?php include "./modules/sign_in.php" ;
    include "./modules/sign_up.php"?>
    
    <script src="../js/script.js"></script>


</header>