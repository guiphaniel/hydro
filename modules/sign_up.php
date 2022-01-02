<?php
    if(!empty($_SESSION['errorSignUp'])){
        echo '<div id="modalSignUp" class="modal show">';
    }
    else{
        echo '<div id="modalSignUp" class="modal">';
    } ?>

    <!-- Modal content -->
    <div class="modal-content">
        
        <span class="close" onclick="show(modalSignUp)">&times;</span>
        <?php if(!empty($_SESSION['errorSignUp'])){
            echo '<div class="errorBox"><h2>'.$_SESSION['errorSignUp'].'</h2></div>';
            $_SESSION['errorSignUp']=null;
        }?>
        <div class="autoLog">
            <div class="g-signin2" data-onsuccess="onSignIn"></div>

        
        </div>
        <div class="hl"></div>
        <form action="./processing/process_sign_up.php" method="post">
            <label for="username" >Pseudo</label>
            <input type="text"  name="username" id="username" required>
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe</label>
            <input type="password"  name="password" id="password" required>
            <label for="checkPassword">Confirmer le mot de passe</label>
            <input type="password" name="checkPassword" id="checkPassword" required>
            <button class="inscription" type="submit">Inscription</button>
        </form>
    </div>
</div>

