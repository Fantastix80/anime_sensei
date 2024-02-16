<?php
require_once "../../src/controller/watchlistController.php";

require_once "../layouts/header.php";
displayMessages();
?>

    <main class="light-bg">
        <div class="bg-vague">
            <section class="barre-recherche flex flex-column aic jcc">
                <h2>Vous recherchez un <span class="clr-secondary">animé</span> précis ?</h2>
                <form method="post" class="flex flex-column aic jcc">
                    <div class="champ-recherche relative">
                        <i class="fa-solid fa-magnifying-glass absolute"></i>
                        <input class="recherche" type="text" name="recherche" placeholder="Entrez le nom de l'animé">
                    </div>
                    <div class="boutons flex jcsb">
                        <button type="submit" name="submit-recherche" class="btn-primary">Rechercher</button>
                    </div>
                </form>
            </section>
        </div>

        <section class="card-container">
            <div class="wrapper">
                <?php
                foreach($animes as $anime):
                    $id_anime = $anime["id"];
                    $tags = $db->getTagsNameOfAnime($id_anime);
                    if($isConnected) {
                        $isInWatchlist = $db->isInWatchlist($_SESSION["id"], $id_anime);
                    }
                ?>
                    
                    <div class="card-animes">
                        <?php if($isConnected): ?>
                            <form method="post">
                                <input type="hidden" name="id_user" value="<?= $_SESSION["id"] ?>">
                                <input type="hidden" name="id_anime" value="<?= $id_anime ?>">
                                <input type="hidden" name="isInWatchlist" value="<?= $isInWatchlist ?>">
                                <button type="submit" name="submit" class="favoris <?= ($isInWatchlist) ? 'fa-solid fa-star' : 'fa-regular fa-star' ?>"></button>
                            </form>
                        <?php endif; ?>
                        <a href="/views/animes/detailsAnimes.php?id=<?= $anime['id'] ?>">
                            <img src="/assets/img/img_animes/<?= $anime["image"] ?>" alt="">
                            <h2 class="title"><?= $anime["original_name"] ?></h2>
                            <div class="tag-container">
                                <?php foreach($tags as $tag): ?>
                                    <p class="tag"><?= $tag["name"] ?></p>
                                <?php endforeach; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

<?php require_once "../layouts/footer.php" ?>