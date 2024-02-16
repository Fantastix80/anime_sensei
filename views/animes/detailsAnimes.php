<?php
require_once "../../src/controller/detailsAnimesController.php";

require_once "../layouts/header.php";
displayMessages();
?>
    <section class="detailsAnime">
        <div class="banniere relative">
            <?php if($isConnected): ?>
                <form method="post">
                    <input type="hidden" name="id_user" value="<?= $_SESSION["id"] ?>">
                    <input type="hidden" name="id_anime" value="<?= $anime["id"] ?>">
                    <input type="hidden" name="isInWatchlist" value="<?= $isInWatchlist ?>">
                    <button type="submit" name="submit" class="favoris <?= ($isInWatchlist) ? 'fa-solid fa-star' : 'fa-regular fa-star' ?>"></button>
                </form>
            <?php endif; ?>
            <img src="/assets/img/img_animes/<?= $anime["image"] ?>" alt="">
        </div>
        <div class="content">
            <div class="titles">
                <div class="flex jcsb aic">
                    <h1 class="original_title"><?= $anime["original_name"] ?></h1>
                    <?php if($isInWatchlist):
                        $anime_info = $db->getAnimeInfoOfUser($_SESSION["id"], $anime["id"]); ?>
                        <form method="post">
                            <input type="hidden" name="date_end" value="<?= $anime_info["date_end_watching"] ?>">
                            <button type="submit" name="submit-fin" class="<?= ($anime_info["date_end_watching"] === null) ? "form-btn-error" : "form-btn-success" ?>"><?= ($anime_info["date_end_watching"] === null) ? "Je n'ai pas terminé l'animé" : "J'ai terminé l'animé" ?></button>
                        </form>
                    <?php endif; ?>
                </div>
                <h2 class="english_title"><?= $anime["english_name"] ?></h2>
            </div>

            <?php if($isInWatchlist): ?>
                <div class="avis">
                    <h3 class="section-title">Avis</h3>
                    <p>Date de visionnage: du <?= $anime_info["date_start_watching"] . " au " . $anime_info["date_end_watching"] ?></p>
                    <p>Note: <?= $anime_info["note"] . "/5" ?></p>
                    <p><span class="underline">Description:</span> <?= $anime_info["opinion"] ?></p>
                    <div class="flex jcc">
                        <a class="btn-primary" href="/views/animes/detailsAnimes.php?id=<?= $anime["id"] ?>&editAvis=1"><?= ($anime_info["opinion"] === null && $anime_info["note"] === null) ? "Ajouter un avis" : "Modifier mon avis" ?></a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($_GET["editAvis"] == "1"): ?>
                <div class="avis-edit">
                    <form method="post">
                        <h1 class="edit-title">Notez votre avis !</h1>
                        <div class="flex jcc aic flex-column gap-8px">
                            <label id="note">Note:</label>
                            <select name="note" id="note">
                                <option <?= ($anime_info["note"] === null) ? "selected" : "" ?> value="">Sélectionnez une note sur 5</option>
                                <?php for($i = 0; $i <= 5; $i++): ?>
                                    <option <?= ($anime_info["note"] !== null && $anime_info["note"] == $i) ? "selected" : "" ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="flex jcc aic flex-column gap-8px">
                            <label for="opinion">Laisser votre avis:</label>
                            <textarea name="opinion" id="opinion" cols="30" rows="10" placeholder="Laissez votre avis ici..."><?= $anime_info["opinion"] ?></textarea>
                        </div>
                        <button type="submit" name="submit-avis" class="form-btn-success">Valider</button>
                        <a href="/views/animes/detailsAnimes.php?id=<?= $anime["id"] ?>" class="form-btn-error">Annuler</a>
                    </form>
                </div>
            <?php endif; ?>

            <div class="informations">
                <h3 class="section-title">Informations</h3>
                <p>Animés en cours: <?= boolval($anime["in_progress"]) ? 'Oui' : 'Non' ?></p>
                <?php if(boolval($anime["in_progress"])):
                    $days = $db->find("days", $anime["release_day"]);
                ?>
                    <p>Jour de sortie: <?= $days["name"] ?></p>
                    <p>Heure de sortie: <?= substr($anime["release_time"], 0, 5) ?></p>
                <?php endif; ?>
            </div>

            <div class="description">
                <h3 class="section-title">Description</h3>
                <p><?= $anime["description"] ?></p>
            </div>

            <div class="genres">
                <h3 class="section-title">Genres</h3>
                <p><?= $tagString ?></p>
            </div>
        </div>
        
    </section>

<?php require_once "../layouts/footer.php" ?>