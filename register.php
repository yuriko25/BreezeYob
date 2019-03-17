<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/index.css">
  <title>Products<?php if(isset($pageName)) { echo " - " . $pageName; } ?></title>
  <script
    src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  </head>
<body>
<h1>Products</h1>
<div class='nav'>
  <?php 
    if(session_status() === PHP_SESSION_NONE) {
      echo "<a href='register.php'>Register</a> | ";
      echo "<a href='login.php'>Login</a>";
      echo "<a href='index.php'>Home</a> | ";
      echo "<a href='logout.php'>Logout</a>";
      echo "<br>";
      echo "REMOVE WHEN DONE | ";      
      echo "<a href='order.php'>Order</a> | ";
      echo "<a href='addProduct.php'>Add a Product</a> | ";
	    echo "<a href='editProduct.php'>Edit a Product/User</a> | ";     
      echo "<a href='register.php'>Create a User</a> | ";      

    }
    
  ?>
  <div class='nav-right'>
  <?php 
    if(session_status() !== PHP_SESSION_NONE) {
      echo "User: " . $_SESSION['name'];
    }
  ?>
  </div>
</div>
<div id='bodyContent'><!-- start of content area -->

<?php
session_start();
$pageName = "Registration";




if(!empty($_POST)) { // Only if we have submitted the form

  // Assign Post elements to their own variables (optional)
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $userAddress = $_POST['userAddress'];
  $userCity = $_POST['userCity'];
  $userPostalCode = $_POST['userPostalCode'];
  $password = $_POST['password'];

  // 1. Connect to the database
  require_once("serverCode/connect.php");
  // 2. Validate input
  // 3. Build query string
  $sql = "INSERT INTO user (userFirstName, userLastName, userEmail, userAddress, userCity, userPostalCode, userPassHash, userAdmin)
          VALUES ('$firstName', '$lastName', '$email', '$userAddress', '$userCity', '$userPostalCode', MD5('$password'));";
  // 4. "Submit"/process query and get/handle results
  $result = $mysqli->query($sql);
  if($result == FALSE) {
    // error
    $errorMessage = "Oops! We messed up. Please try again.";
  } else {
    // succeeded
    $successMessage = "Successfully created user.";
  }
}

?>
<div style='width: 300px; margin: 0 auto;'>
  <h2>User Registration</h2>
  <?php

  if(isset($errorMessage)) {
    echo "<div class='error'>$errorMessage</div>";
  } else if(isset($successMessage)) {
    echo "<div class='success'>$successMessage</div>";
  }

  ?>
  <form method='post'>
    <div><label for='firstName'>First Name:</label></div>
      <div><input type='text' id='firstName' name='firstName' placeholder='Enter your first name.'></div>
    <div><label for='lastName'>Last Name:</label></div>
      <div><input type='text' name='lastName' placeholder='Enter your last name.'></div>
    <div><label for='email'>Email Address:</label></div>
      <div><input type='text' name='email' placeholder='Enter your email address.'></div>
    <div><label for='password'>Password:</label></div>
      <div><input type='text' name='password' placeholder='Enter your password.'></div>
    <div>
  <div><label for='userAddress'>Address:</label></div>
    <div><input type='text' name='userAddress'  placeholder='Enter your Address.'></div>
  <div>
  <div><label for='userCity'>City:</label></div>
    <div><input type='text' name='userCity'  placeholder='Enter your City.'></div>
  <div>
  <div><label for='userPostalCode'>Postal Code:</label></div>
    <div><input type='text' name='userPostalCode'  placeholder='Enter your PostalCode.'></div>
  <div>      
      <input type='submit' value='Register'>
      <input type='reset' value='Clear'>
    </div>
  </form>
</div>
<?php require_once("footer.php"); ?>