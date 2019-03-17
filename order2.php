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

<!--Create a table to fill in -->

<table border="1">
  <tr>
    <th>Picture</th>
    <th>Name</th> 
    <th>Inv</th>
    <th>Desc</th>
    <th>Price</th>
    <th>Amt</th>
  </tr>
  <tr>
    <td><img src="images/1.jpg"></td>
    <td>prod 1</td> 
    <td><?php $sql = "SELECT productsInv FROM products WHERE productsID = 1;" ?></td>
    <td>This is prod 1</td>
    <td id='val1'>9.91</td>
    <td id='qty1' class="count-me"><input type=\"number\" name=\"$id\" $_SESSION['qty1']></td>
    <td id="subCost1" id="totalCost">
    <script>
    function calculate() {
      var qty1 = document.getElementById('qty1').value; 
      var val1 = document.getElementById('val1').value;
      //var result = document.getElementById('result'); 
      var subCost1 = qty1 * val1;
      result.innerHTML = subCost1;
} subCost1
</script>
    </td>
  </tr>
  <tr>
    <td><img src="images/2.jpg"></td>
    <td>prod 2</td> 
    <td><?php  ?></td>    
    <td>This is prod 1</td>
    <td>9.92</td>
    <td id='qty2' class="count-me"><input type=\"number\" name=\"$id\" $_SESSION['qty2']></td> 
    <td id="subCost2" id="totalCost"></td>
  </tr>
  <tr>
    <td><img src="images/3.jpg"></td>
    <td>prod 3</td> 
    <td><?php  ?></td>
    <td>This is prod 1</td>
    <td>9.93</td>
    <td id='qty3' class="count-me"><input type=\"number\" name=\"$id\" $_SESSION['qty3']></td> 
    <td id="subCost3" id="totalCost"></td>
  </tr>
  <tr>
    <td></td>
    <td></td> 
    <td></td>
    <td>Totals</td>
    <td id="totalProd"></td> 
    <td id="totalCost"></td>
  </tr>
</table>
  </form>
  
    <div>
      <input type="submit" value="Submit Order">
    </div>

<?php require_once("footer.php"); ?>
