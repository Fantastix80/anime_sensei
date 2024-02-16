<?php

require_once "../../src/services/isConnected.php";
require_once "../../src/services/alert.php";
require_once "../../src/database/db_functions.php";

// Creating a new instance of the class Database to then use it to interact with the database
$db = new Database();

// If URL is correct
if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
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

    // If form is submitted
    if(isset($_POST["submit-fin"])) {
        $date_end = $_POST["date_end"];

        // Set new date to null or today's date whether we want to add one or remove it.
        if($date_end == "") {
            $data = ["date_end_watching" => date("Y-m-d")];
        } else {
            $data = ["date_end_watching" => null];
        }
        
        $db->updateWatchlist($data, $_SESSION["id"], $_GET["id"]);
        alert("success", "Vous avez bien mis à jour cet animé.");
    }

    // If form is submitted
    if(isset($_POST["submit-avis"])) {
        $note = $_POST["note"];
        $opinion = htmlspecialchars($_POST["opinion"]);

        // Set variables to null if there're empty
        if($note == "") {
            $note = null;
        }
        if($opinion == "") {
            $opinion = null;
        }

        $data = [
            "note" => $note,
            "opinion" => $opinion
        ];

        $db->updateWatchlist($data, $_SESSION["id"], $_GET["id"]);
        alert("success", "Vous avez bien ajouté votre avis pour cet animé.");
        header("location:/views/animes/detailsAnimes.php?id=".$_GET["id"]);
        exit();
    }

    // Get all datas needed for the page
    $anime = $db->find("animes", $_GET["id"]);
    $tags = $db->getTagsNameOfAnime($_GET["id"]);
    $tagNames = array_column($tags, "name");
    $tagString = implode(", ", $tagNames);

    // Check if user is connected to know if we have to show the stars to add to the watchlist
    if($isConnected) {
        $isInWatchlist = $db->isInWatchlist($_SESSION["id"], $_GET["id"]);
    } else {
        $isInWatchlist = false;
    }
} else {
    // Redirect user if the URL is incorrect
    alert("error", "Erreur lors du chargement de cet animé.");
    header("location:/views/animes/listeAnimes.php");
    exit();
}