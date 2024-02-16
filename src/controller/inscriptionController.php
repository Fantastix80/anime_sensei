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
    // Check if cgu is checked
    if($_POST["accept-cgu"] == true)
    {
        // Check that all the fields are validate according to our rules
        $lastname = new validationFunctions(htmlspecialchars($_POST["lastname"]));
        $firstname = new validationFunctions(htmlspecialchars($_POST["firstname"]));
        $email = new validationFunctions(htmlspecialchars($_POST["email"]));
        $password = new validationFunctions(htmlspecialchars($_POST["password"]));
    
        if($lastname->isNotBlank() && $firstname->isNotBlank() && $email->isNotBlank() && $password->isNotBlank()) {
            if($lastname->minLength(2) && $lastname->maxLength(50)) {
                if($firstname->minLength(2) && $firstname->maxLength(50)) {
                    if($email->isEmailValid()) {
                        if($password->isPasswordValid()) {
                            // Check if email already used
                            if(!$db->Exist("users", "email", $email->getData())) {
                                // Create user
                                $data = [
                                    "firstname" => $firstname->getData(),
                                    "lastname" => $lastname->getData(),
                                    "email" => $email->getData(),
                                    "password" => hash('sha512', $password->getData())
                                ];
                                $db->create("users", $data);

                                // Get last inserted id to connect the user
                                $id_inserted = $db->getLastIdInserted()["LAST_INSERT_ID()"];

                                if(is_numeric($id_inserted)) {
                                    $_SESSION["id"] = $id_inserted;
                                }

                                alert("success", "Inscription réussite avec succès.");

                                // Redirect the user to the homepage
                                header("location:/index.php");
                                exit();
                            } else {
                                alert("error", "Cette email est déjà associé à un compte, essayez de vous connecter.");
                            }
                        } else {
                            alert("error", "Le mot de passe ne respecte pas les critères de sécurité.");
                        }
                    } else {
                        alert("error", "L'email n'est pas valide.");
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
    } else {
        alert("error", "Veuillez accepter les conditions générales d'utilisation.");
    }
}

?>