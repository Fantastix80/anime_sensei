<?php

require_once "../../src/services/isConnected.php";
require_once "../../src/services/alert.php";
require_once "../../src/database/db_functions.php";
require_once "../../src/services/validationFunctions.php";

// Creating a new instance of the class Database to then use it to interact with the database
$db = new Database();

if($isConnected) {
    // Get a specific user informations
    $user = $db->find("users", $_SESSION["id"]);

    // If form is submitted
    if(isset($_POST["submit"])) {
        // Check that all the fields are validate according to our rules
        $lastname = new validationFunctions(htmlspecialchars($_POST["lastname"]));
        $firstname = new validationFunctions(htmlspecialchars($_POST["firstname"]));
        $password = new validationFunctions(htmlspecialchars($_POST["password"]));

        if($lastname->isNotBlank() && $firstname->isNotBlank() && $password->isNotBlank()) {
            if($lastname->minLength(2) && $lastname->maxLength(50)) {
                if($firstname->minLength(2) && $firstname->maxLength(50)) {
                    if($password->isPasswordValid()) {
                        // Update user information
                        $data = [
                            "firstname" => $firstname->getData(),
                            "lastname" => $lastname->getData(),
                            "password" => hash('sha512', $password->getData())
                        ];
                        $db->update("users", $data, $_SESSION["id"]);

                        alert("success", "Modification réussite avec succès.");

                        // Redirect the user to the homepage
                        header("location:/index.php");
                        exit();
                    } else {
                        alert("error", "Le mot de passe ne respecte pas les critères de sécurité.");
                    }
                } else {
                    alert("error", "Le champ prénom doit comprendre entre 2 et 50 caractères.");
                }
            } else {
                alert("error", "Le champ nom doit comprendre entre 2 et 50 caractères.");
            }
        } else {
            alert("error", "Veuillez remplir tous les champs.");
        }
    }
} else {
    alert("error", "Veuillez vous connecter afin de pouvoir accéder à cette page.");
    header("location:/index.php");
    exit();
}

