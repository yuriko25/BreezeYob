<?php
session_start();
$pageName = "Add Products";
require_once("header.php");

if(!empty($_POST)) { // Only if we have submitted the form

  // Assign Post elements to their own variables (optional)
  $productsName = $_POST['productsName'];
  $productsDesc = $_POST['productsDesc'];
  $productsCost = $_POST['productsCost'];
  $productsInv = $_POST['productsInv'];

  // 1. Connect to the database
  require_once("serverCode/connect.php");
  // 2. Validate input
  // 3. Build query string
  $sql = "INSERT INTO products (productsName, productsDesc, productsCost, productsInv)
          VALUES ('$productsName', '$productsDesc', '$productsCost', '$productsInv');";
		  
  // 4. "Submit"process query and get/handle results
  $result = $mysqli->query($sql);
  if($result == FALSE) {
    // error
    $errorMessage = "Oops! We messed up. Please try again.";
  } else {
    // succeeded
    $successMessage = "Successfully created product.";
  }
}

?>
<div style='width: 300px; margin: 0 auto;'>
  <h2>Add Products</h2>
  <?php

  if(isset($errorMessage)) {
    echo "<div class='error'>$errorMessage</div>";
  } else if(isset($successMessage)) {
    echo "<div class='success'>$successMessage</div>";
  }

  ?>
  <form method='post'>
    <div><label for='productsName'>Products Name:</label></div>
      <div><input type='text' id='productsName' name='productsName' placeholder='Enter your Product name.'></div>
    <div><label for='productsDesc'>Products Description:</label></div>
      <div><input type='text' name='productsDesc' placeholder='Product Description.'></div>
    <div><label for='productsCost'>Products Cost:</label></div>
      <div><input type='text' name='productsCost' placeholder='Products Cost .'></div>
    <div><label for='productsInv'>Products Inv:</label></div>
      <div><input type='text' name='productsInv' placeholder='Enter your products Inv.'></div>
    <div>
      <input type='submit' value='Register'>
      <input type='reset' value='Clear'>
    </div>
  </form>
</div>
<?php require_once("footer.php"); ?>