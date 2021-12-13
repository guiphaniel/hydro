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
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
         
        </div>
        <div class="hl"></div>
        <form action="./processing/process_sign_in.php" method="POST">
            <label for="username">Identifiant</label>
            <input type="text" autocomplete="username" name="username" id="sign-in-username">
            <label for="password">Mot de passe</label>
            <input type="password" autocomplete="current-password" name="password" id="sign-in-password">
            <button class="connexion" type="submit">Connexion</button>
        </form>
    </div>
</div>