<?php
    if(session_status() === PHP_SESSION_NONE) {
      session_start();
      
    }
    if(!isset($_SESSION['loggedIn'])) {
        // not logged in.
        header("Location: login.php");
    }

?>