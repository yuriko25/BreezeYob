<?php 
  session_start();
  $pageName="Order";
  require_once("header.php");
 // require_once("serverCode/checklogin.php");
  require_once("serverCode/connect.php");   
?>

<!--Contact information-->
<form method='post'>
      <h3>Contact Information:</h3>   
    	<div id="errorMessage" class='errorMessage' style="color:white;"></div>
  <div>    
        <div class='formInput percent50'>First name:<br>
        <?php echo "<input type='text' name='txtFirstName' id='txtFirstName' value='" . $_SESSION['userFirstName'] ."'>"; ?></div>    
      <div class='formInput percent50'>Last name:<br>
      <?php echo "<input type='text' name='txtLastName' id='txtLastName' value='" . $_SESSION['userLastName'] ."'>"; ?></div>
        <div class='formInput percent100'>Address:<br>
        <?php echo "<input type='text' name='txtAddress' id='txtAddress' value='" . $_SESSION['userAddress'] ."'>"; ?></div>
      <div class='formInput percent50'>City:<br>
      <?php echo "<input type='text' name='txtCity' id='txtCity' value='" . $_SESSION['userCity'] ."'>"; ?></div>
        <div class='formInput percent50'>Postal Code:<br>
        <?php echo "<input type='text' name='txtPostalCode' id='txtPostalCode' value='" . $_SESSION['userPostalCode'] ."'>"; ?></div>
      <div class='formInput percent100'>Email:<br>
      <?php echo "<input type='text' name='txtEmail' id='txtEmail' value='" . $_SESSION['userEmail'] ."'>"; ?></div>
    </div>
      <div class='formInput percent100'>Notes:<br>
      <?php echo "<input type='text' name='txtNotes' id='txtNotes' value='" . 'notes' ."'>"; ?></div>
  </div>

<?php
//Create a table to fill in
echo "<table border=1>";
echo "<tr><th>Image</th><th>Name</th><th>Product Description</th><th>Inventory</th><th>Cost</th><th>Order</th></tr>";

$sql = "Select * FROM products;";    
$result = $mysqli->query($sql);

// add a variable to store the running subtotal in:
$subtotal = 0;

while($row = $result->fetch_assoc()) {

    // add the cost of the current product to $subtotal
    // and make sure it is a float value:
    $subtotal = ($row['productsCost']);

    $id = $row['productsID'];
    echo "<tr>";    // Start columns*/    
    echo "<td><img src=\"images/$id.jpg\"/></td>";  // Image column     
    echo "<td>" . $row['productsName'] . "</td>";   // Name column
    echo "<td>" . $row['productsDesc'] . "</td>";   // Image column     
    echo "<td>" . $row['productsInv'] . "</td>";    // Inv column
    echo "<td>" . $row['productsCost'] . "</td>";   // Cost     
    echo "<td id='qty'><input type=\"number\" name=\"$id\"></td>"; // orderAmt column
    // output the subtotal:
   // echo "<td>$subtotal</td>";  // Subtotals column
    echo "</tr>";       // end columns
}
echo "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
echo "</table>";        // end table
?>
  <script src="clientCode\validate.js"></script>
  </form>
  
    <div>
      <input type="submit" value="Submit Order">
    </div>
<?php require_once("footer.php"); ?>