<?php 
session_start();
require_once("header.php"); 
require_once("serverCode/connect.php");
// 1. The user ID of the user you want to edit should be in $_GET['id'] 
// (or possibly $_POST['id'] depending on whether you have submitted the form already.)
// if you cannot find a numeric value here, redirect back to admin.php
$id = $_GET['id'];
if(!is_numeric($id)) {
  header("Location: admin.php");
}

// 2. Ensure you've received a POST request before completing 
//    steps 3 and 4
if(!empty($_POST)) {
  
  $productsName = $_POST['productsName'];
  $productsDesc = $_POST['productsDesc'];
  $productsCost = $_POST['productsCost'];
  $productsInv = $_POST['productsInv'];
  $productsDateAdded = $_POST['productsDateAdded'];  
  // 3. Validate input. Let the user know if they entered a blank product or last name, or productsCost.
  if(empty($productsName)) {
    // Product name is blank. error.
    $errorMessage = "Product name is required.";
  } else if(empty($productsDesc)) {
    // product Desc. is blank. error.
    $errorMessage = "Product Desc. is required.";
  } else if(empty($productsCost)) {
    // products Cost is blank. error.
    $errorMessage = "products Cost is required.";
  } else if(empty($productsInv)) {
    // Product Inv is blank. error.
    $errorMessage = "Product Inv is required.";
  } else if(empty($productsDateAdded)) {
    // Date added is blank. error.
    $errorMessage = "Date added is required.";

  } else {
    // 4. If all validation passes, apply an UPDATE against your database.
    //    - check that this UPDATE worked ($mysqli->query() will be FALSE if it did not work)
    $sql = "UPDATE products SET 
      productsName = '$productsName', 
      productsDesc = '$productsDesc',
      productsCost = '$productsCost', 
      productsInv = '$productsInv', 
      productsDateAdded = '$productsDateAdded'
        WHERE productsID = $id";
    $result = $mysqli->query($sql);
    if(!$result) {
      // Failed query
      $errorMessage = "Something went wrong. Error Message: " . $mysqli->error;
    } else {
      $successMessage = "Successfully updated record.";
    }
  }

}

// 5. Ensure you requery the database to get the current user information to populate the form 
//    below (look at the value attributes)
//    - You should do this whether you have posted the form or not, but 
//      process steps 2,3 & 4 (if applicable) beforehand

$result = $mysqli->query("SELECT * FROM products WHERE productsID=$id");
$row = $result->fetch_assoc();

$productsName = $row['productsName'];
$productsDesc = $row['productsDesc'];
$productsCost = $row['productsCost'];
$productsInv = $row['productsInv'];
$productsDateAdded = $row['productsDateAdded'];

?>
<h2>Edit User</h2>
<?php

  if(isset($errorMessage)) {
    echo "<div class='error'>$errorMessage</div>";
  } else if(isset($successMessage)) {
    echo "<div class='success'>$successMessage</div>";
  }

  ?>
<form method='post'>
  <div><label for='productsName'>Products Name:</label></div>
    <div><input type='text' id='productsName' name='productsName' value='<?php echo($productsName); ?>'></div>
  <div><label for='productsDesc'>Products Desc:</label></div>
    <div><input type='text' name='productsDesc' value='<?php echo($productsDesc); ?>'></div>
  <div><label for='productsCost'>products Cost:</label></div>
    <div><input type='text' name='productsCost' value='<?php echo($productsCost); ?>'></div>
  <div>
  <div><label for='productsInv'>Product Inv:</label></div>
    <div><input type='text' name='productsInv' value='<?php echo($productsInv); ?>'></div>
  <div>
  <div><label for='productsDateAdded'>products Inv:</label></div>
    <div><input type='text' name='productsDateAdded' value='<?php echo($productsDateAdded); ?>'></div>
  <div>  
    <input type='submit' value='Update'>
    <input type='reset' value='Reset'>
  </div>
</form>

<?php require_once("footer.php"); ?>