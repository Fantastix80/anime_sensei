<?php
require_once "../../src/controller/connexionController.php";

require_once "../layouts/header.php";
displayMessages();
?>

<section class="background-color-gradient">
    <div class="form-container">
        <div class="header flex flex-column jcc aic">
            <img src="/assets/img/connexion.svg" alt="">
            <h2>Heureux de vous revoir</h2>
            <h3>Connectez-vous</h3>
        </div>
        <form method="post" class="form">
            <div class="form-item flex flex-column">
                <label for="email" class="label-form">Email</label>
                <input class="input-form" type="text" id="email" name="email">
            </div>
            <div class="form-item flex flex-column">
                <label for="password" class="label-form">Mot de passe</label>
                <input class="input-form" type="password" id="password" name="password">
            </div>
            <button type="submit" name="submit" class="btn-primary btn-submit-form">Se connecter</button>
            <div class="separateur">
                <span class="relative">Pas encore inscrit ?</span>
            </div>
            <a href="/views/inscription/inscription.php" class="btn-secondary btn-other-choice">S'inscrire</a>
        </form>
    </div>
</section>

<?php require_once "../layouts/footer.php" ?>