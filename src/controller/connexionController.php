<?php

require_once "../../src/services/isConnected.php";
require_once "../../src/services/alert.php";
require_once "../../src/services/validationFunctions.php";
require_once "../../src/database/db_functions.php";

// Creating a new instance of the class Database to then use it to interact with the database
$db = new Database();

// Check if form is submitted
if(isset($_POST["submit"]))
{
    $email = htmlspecialchars($_POST["email"]);
    $password = hash("sha512", htmlspecialchars($_POST["password"]));

    // Check if credentials are correct
    $data = $db->findWhere("users", "email", $email)->fetch(PDO::FETCH_ASSOC);
    if($data && $data["password"] == $password) {
        alert("success", "Connexion réussie avec succès.");
        
        $_SESSION["id"] = $data["id"];

        header("location:/index.php");
        exit();
    } else {
        alert("error", "Votre email ou votre mot de passe est incorrect.");
    }
}

?>