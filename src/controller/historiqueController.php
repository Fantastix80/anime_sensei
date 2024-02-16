<?php

require_once "../../src/services/isConnected.php";
require_once "../../src/services/alert.php";
require_once "../../src/database/db_functions.php";

// Check if the user is connected
if($isConnected) {
    // Creating a new instance of the class Database to then use it to interact with the database
    $db = new Database();

    // If form is submitted
    if(isset($_POST["submit"])) {
        $id_user = $_POST["id_user"];
        $id_anime = $_POST["id_anime"];
        $isInWatchlist = boolval($_POST["isInWatchlist"]);

        // Delete or add anime into watchlist whether the anime is already or not into the watchlist
        if($isInWatchlist) {
            $data = [
                "id_user" => $id_user,
                "id_anime" => $id_anime
            ];
        
            $db->deleteMultipleKey("watchlist", $data);
            alert("success", "Vous avez bien retiré cet animé de votre watchlist.");
        } else {
            $data = [
                "id_user" => $id_user,
                "id_anime" => $id_anime,
                "date_start_watching" => date("Y-m-d")
            ];
        
            $db->create("watchlist", $data);
            alert("success", "Vous avez bien ajouté cet animé à votre watchlist.");
        }
    }

    // Get all animes in watchlist ( also joins it with the actual animes informations)
    if(isset($_POST["submit-recherche"])) {
        $recherche = htmlspecialchars($_POST["recherche"]);
    
        $data = [
            "original_name" => "%".$recherche."%",
            "english_name" => "%".$recherche."%",
            "description" => "%".$recherche."%"
        ];
    
        $animes = $db->findAnimesInWatchlistLike($_SESSION["id"], $data, false);
    } else {
        $animes = $db->findAnimesInWatchlist($_SESSION["id"], false);
    }
} else {
    // Redirect user if he isn't connected
    alert("error", "Veuillez vous connecter afin de pouvoir accéder à cette page.");
    header("location:/index.php");
    exit();
}
