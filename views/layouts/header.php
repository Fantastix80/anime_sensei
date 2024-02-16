<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeSensei</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/93fa0f985e.js" crossorigin="anonymous"></script>
</head>
<body class="background-color-gradient"> 
    <header class="flex aic jcsb">
        <div>
            <h1><a href="/index.php" class="logo-site">AnimeSensei</a></h1>
        </div>
        <nav class="flex">
            <ul class="flex">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/views/animes/listeAnimes.php">Liste animés</a></li>
                <li><a href="/views/animes/watchlist.php">Watchlist</a></li>
                <li><a href="/views/animes/historique.php">Historique</a></li>
            </ul>
            <ul class="flex">
                <?php if(!isset($_SESSION["id"])): ?>
                    <li><a href="/views/inscription/inscription.php" class="btn-primary">Inscription</a></li>
                    <li><a href="/views/connexion/connexion.php" class="btn-secondary">Connexion</a></li>
                <?php else: ?>
                    <li><a href="/views/utilisateurs/monCompte.php" class="btn-primary">Mon compte</a></li>
                    <li><a href="/views/utilisateurs/deconnexion.php" class="btn-secondary">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="mt-header">