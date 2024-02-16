<?php
require_once "../../src/controller/inscriptionController.php";

require_once "../layouts/header.php";

displayMessages();
?>

<section class="background-color-gradient">
    <div class="form-container">
        <div class="header flex flex-column jcc aic">
            <img src="/assets/img/inscription.svg" alt="">
            <h2>Prêt pour votre créer votre watchlist ?</h2>
            <h3>Créez votre compte en 2 minutes !</h3>
        </div>
        <form method="post" class="form">
            <div class="form-item flex flex-column">
                <label for="lastname" class="label-form">Nom</label>
                <input class="input-form" type="text" id="lastname" name="lastname">
            </div>
            <div class="form-item flex flex-column">
                <label for="firstname" class="label-form">Prénom</label>
                <input class="input-form" type="text" id="firstname" name="firstname">
            </div>
            <div class="form-item flex flex-column">
                <label for="email" class="label-form">Email</label>
                <input class="input-form" type="text" id="email" name="email">
            </div>
            <div class="form-item flex flex-column">
                <label for="password" class="label-form">Mot de passe</label>
                <input class="input-form" type="password" id="password" name="password">
                <p class="hint">8 caractères minimum</p>
                <p class="hint">1 minuscule minimum</p>
                <p class="hint">1 majuscule minimum</p>
                <p class="hint">1 chiffre minimum</p>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="accept-cgu" name="accept-cgu">
                <label for="accept-cgu">J'ai lu et j'accepte les <a href="">Conditions Générales</a></label>
            </div>
            <button type="submit" name="submit" class="btn-primary btn-submit-form">S'inscrire</button>
            <div class="separateur">
                <span class="relative">Déjà inscrit ?</span>
            </div>
            <a href="/views/connexion/connexion.php" class="btn-secondary btn-other-choice">Se connecter</a>
        </form>
    </div>
</section>

<?php require_once "../layouts/footer.php" ?>
