<?php
    if(!empty($_SESSION['errorSignIn'])){
        echo '<div id="modalSignIn" class="modal show">';
    }
    else{
        echo '<div id="modalSignIn" class="modal">';
    } 
?>
    <div class="modal-content">
        <span class="close" onclick="show(modalSignIn)">&times;</span>
        <?php if(!empty($_SESSION['errorSignIn'])){
            echo '<div class="errorBox"><h2>'.$_SESSION['errorSignIn'].'</h2></div>';
            $_SESSION['errorSignIn']=null;
        }?>
        <div class="autoLog">
            <button>Se connecter avec Google</button>
            <button>Se connecter avec Facebook</button>
        </div>
        <div class="hl"></div>
        <form action="./processing/process_sign_in.php" method="POST">
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <button class="connexion" type="submit">Connexion</button>
        </form>
    </div>
</div>