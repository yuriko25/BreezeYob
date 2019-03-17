<?php

if(!empty($_POST)) {
  // Data has been submitted via POST method

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM USER 
          WHERE userEmail='$email' 
          AND userPassHash=MD5('$password')";

  // Use this to test your SQL code: 
  // print $sql;

  require_once("serverCode/connect.php");

  $result = $mysqli->query($sql);

  if($result == FALSE) { // equivalent: if(!$result)
    // If its FALSE, there was probable some sort of SQL error.
    // Error message, or stop the script.
    $errorMessage = "There was an error in the SQL used on this page.\nMessage:" + $mysqli->error;
  } else {
    // We got a recordset
    // But it could be empty. Let's check
    if($row = $result->fetch_assoc()) {
      // We found a record.
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['userID'] = $row['userID'];
      $_SESSION['name'] = $row['userFirstName'] . ' ' . $row['userLastName'];
      $_SESSION['userID'] = $row['userID'];
      $_SESSION['userFirstName'] = $row['userFirstName'];
      $_SESSION['userLastName'] = $row['userLastName'];

      $_SESSION['userAddress'] = $row['userAddress'];
      $_SESSION['userCity'] = $row['userCity'];

      $_SESSION['userPostalCode'] = $row['userPostalCode'];
      $_SESSION['userEmail'] = $row['userEmail'];

      header("Location: order.php");
    }
  }

}

?>
<?php require("header.php"); ?>

<div style='width: 300px; margin: 0 auto;'>
  <h2>Login</h2>
  <?php
    if(isset($errorMessage)) {
      echo "<div class='error'>" + $errorMessage + "</div>";
    }
  ?>
  <form method='post'>
    <div><label for='email'>Email Address:</label></div>
      <div><input type='text' name='email' placeholder='Enter your email address.'></div>
    <div><label for='password'>Password:</label></div>
      <div><input type='text' name='password' placeholder='Enter your password.'></div>
    <div>
      <input type='submit' value='Login'>
    </div>
  </form>
</div>

<?php require_once("footer.php"); ?>