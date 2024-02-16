<?php

require_once "../../src/services/isConnected.php";

unset($_SESSION["id"]);

header("location:/index.php");