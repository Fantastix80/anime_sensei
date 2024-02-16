<?php
require_once "../../src/controller/compteController.php";

require_once "../layouts/header.php";

displayMessages();
?>

<section class="compte">
    <h1>Mon compte</h1>
    <form method="post">
        <div class="flex flex-column gap-8px">
            <label for="firstname">Prénom:</label>
            <input type="text" name="firstname" id="firstname" value="<?= $user["firstname"] ?>">
        </div>
        <div class="flex flex-column gap-8px">
            <label for="lastname">Nom:</label>
            <input type="text" name="lastname" id="lastname" value="<?= $user["lastname"] ?>">
        </div>
        <div class="flex flex-column gap-8px">
            <label for="email">Email:</label>
            <input type="text" id="email" value="<?= $user["email"] ?>" disabled>
        </div>
        <div class="flex flex-column gap-8px">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password">
        </div>
        
        <button type="submit" name="submit" class="form-btn-success">Modifier mes informations</button>
    </form>
</section>

<?php require_once "../layouts/footer.php" ?>