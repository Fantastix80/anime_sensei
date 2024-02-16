<?php

require_once "src/services/isConnected.php";
require_once "src/services/alert.php";
require_once "src/database/db_functions.php";

// Creating a new instance of the class Database to then use it to interact with the database
$db = new Database();

// Get all users informations
$data = $db->findAll("users");

// Get the count of all users
$numberOfUsers = count($data);
