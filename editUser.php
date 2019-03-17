<?php 
session_start();
require_once("header.php"); 
require_once("serverCode/connect.php");

// 1. The user ID of the user you want to edit should be in $_GET['id'] 

$id = $_GET['id'];
if(!is_numeric($id)) {
  header("Location: admin.php");
}

// 2. Ensure you've received a POST request before completing 
//    steps 3 and 4
if(!empty($_POST)) {
  
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phone= $_POST['userPhone'];
  $userAddress= $_POST['userAddress'];
  $city= $_POST['userCity'];
  $postal= $_POST['userPostalCode'];
  $userAdmin = $_POST['userAdmin'];

  // 3. Validate input. Let the user know if they entered a blank first or last name, or email.
  if(empty($firstName)) {
    // first name is blank. error.
    $errorMessage = "First name is required.";
  } else if(empty($lastName)) {
    // last name is blank. error.
    $errorMessage = "Last name is required.";
  } else if(empty($email)) {
    // email is blank. error.
    $errorMessage = "Email is required.";
  } else {
    // 4. If all validation passes, apply an UPDATE against your database.
    //    - check that this UPDATE worked ($mysqli->query() will be FALSE if it did not work)
    $sql = "UPDATE USER SET 
            userFirstName = '$firstName', 
            userLastName = '$lastName',
            userEmail = '$email',
            userPhone = '$phone',
            userAddress = '$userAddress',
            userCity = '$city',
            userPostalCode = '$postal',
            userAdmin = '$userAdmin' 
            WHERE userID = $id";
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

$result = $mysqli->query("SELECT * FROM USER WHERE userID=$id");
$row = $result->fetch_assoc();

$firstName = $row['userFirstName'];
$lastName = $row['userLastName'];
$email = $row['userEmail'];
$phone= $row['userPhone'];
$address= $row['userAddress'];
$city= $row['userCity'];
$postal= $row['userPostalCode'];
$userAdmin = $row['userAdmin'];

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
  <div><label for='firstName'>First Name:</label></div>
    <div><input type='text' id='firstName' name='firstName' value='<?php echo($firstName); ?>'></div>
  <div><label for='lastName'>Last Name:</label></div>
    <div><input type='text' name='lastName' value='<?php echo($lastName); ?>'></div>
  <div><label for='email'>Email Address:</label></div>
    <div><input type='text' name='email' value='<?php echo($email); ?>'></div>
  <div>
  <div><label for='userAdmin'>user Admin? 1=yes 0=No:</label></div>
    <div><input type='text' name='userAdmin' value='<?php echo($userAdmin); ?>'></div>
  <div>
  <div><label for='userAddress'>Address:</label></div>
    <div><input type='text' name='userAdmin' value='<?php echo($address); ?>'></div>
  <div>
  <div><label for='userCity'>City:</label></div>
    <div><input type='text' name='userCity' value='<?php echo($city); ?>'></div>
  <div>
  <div><label for='userPostalCode'>Postal Code:</label></div>
    <div><input type='text' name='userPostalCode' value='<?php echo($postal); ?>'></div>
  <div>    
    <input type='submit' value='Update'>
    <input type='reset' value='Reset'>
  </div>
</form>

<?php require_once("footer.php"); ?>