<?php
require_once "src/controller/accueilController.php";

require_once "views/layouts/header.php";

displayMessages();
?>

<section class="accueil flex aic">
    <div class="details">
        <h2>Gérer vos animés <br><span class="clr-secondary">facilement et rapidement</span></h2>
        <h3><span class="clr-secondary"><?= $numberOfUsers ?></span> utilisateurs inscrits sur AnimeSensei</h3>
        <div class="boutons flex jcs gap-4">
            <a href="/views/animes/listeAnimes.php" class="btn-primary">Voir la liste des animés</a>
            <a href="/views/animes/watchlist.php" class="btn-secondary">Ma watchlist</a>
        </div>
    </div>
    <div class="image">
        <img src="/assets/img/image-accueil.svg" alt="Image d'accueil">
    </div>
</section>

<?php require_once "views/layouts/footer.php" ?>