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
            <button>S'inscrire avec Google</button>
            <button>S'inscrire avec Facebook</button>
        </div>
        <div class="hl"></div>
        <form action="./processing/process_sign_up.php" method="post">
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username">
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <label for="checkPassword">Confirmer le mot de passe</label>
            <input type="password" name="checkPassword" id="checkPassword">
            <button class="inscription" type="submit">Inscription</button>
        </form>
    </div>
</div>