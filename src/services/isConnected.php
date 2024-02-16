<?php

// Start the session
session_start();

// Set the variable isConnected to true or false wheter the user is or not connected
$isConnected = false;
if (isset($_SESSION['id'])) {
    $isConnected = true;
    $id = $_SESSION["id"];
}