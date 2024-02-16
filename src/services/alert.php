<?php

// This function is used to add a message (error or success). It will just push it into two arrays that will live in the session variable so we can use it wherever we want 
function alert(string $type, string $message)
{
    if ($type == 'success'){
        if (!isset($_SESSION['successes'])){
            $_SESSION['successes'] = [];
        }
        array_push($_SESSION['successes'], $message);
    } else if ($type == 'error'){
        if (!isset($_SESSION['errors'])){
            $_SESSION['errors'] = [];
        }
        array_push($_SESSION['errors'], $message);
    }
}

// This function is used to display the message on the page. When called, it will print the message and destroy it from the array right after it to prevent displaying it multiple times
function displayMessages(){
    if (isset($_SESSION['successes'])) {
        foreach ($_SESSION['successes'] as $success){
            echo '<p class="message alert-success msg-hidden"><span style="display: flex; align-items: center;"><i style="color: green; font-size: 1.5rem; padding-right: 1rem;" class="fa-regular fa-circle-check"></i>'.$success.'</span><i class="fas fa-times" style="color: red!important;" onclick="this.parentElement.style.display = `none`;"></i></p>';
        }
        unset($_SESSION['successes']);
    }
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error){
            echo '<p class="message alert-danger msg-hidden"><span style="display: flex; align-items: center;"><i style="color: red; font-size: 1.5rem; padding-right: 1rem;" class="fa-solid fa-xmark"></i>'.$error.'</span><i class="fas fa-times" style="color: red!important;" onclick="this.parentElement.style.display = `none`;"></i></p>';
        }
        unset($_SESSION['errors']);
    }
}