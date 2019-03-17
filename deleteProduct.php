<?php

session_start();
if(!isset($_SESSION['loggedIn'])) {
    // not logged in.
    header("Location: login.php");
} else {

    if(!empty($_POST)) {
        // a form has been posted to this page
        $id = $_POST['id'];
        require_once("serverCode/connect.php");
        $sql = "DELETE FROM products WHERE productsID=$id";
    
        $result = $mysqli->query($sql);
    
        if($result) {
            // Our delete was successful
            header("Location: admin.php");
        } else {
            // unsuccessful
            echo("Something went wrong.");
        }
    }

    $id = $_GET['id'];
    echo("Are you sure?");
    echo("<form method='POST'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' value='Yes, delete'>
        </form>");
    
}