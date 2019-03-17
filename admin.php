
<?php 
  session_start();
  $pageName="Admin";
  require_once("header.php");
  require_once("serverCode/checklogin.php");
  require_once("serverCode/connect.php");
    echo("<h3>Users</h3>");
  $sql = "SELECT * FROM USER";

  $result = $mysqli->query($sql);

  echo("<table border=1>");
  echo("<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Postal</th></tr>");
  while($row = $result->fetch_assoc()) {
    $id = $row['userID'];
    echo("<tr>");
    echo("<td>$id</td>");
    echo("<td>" . $row['userFirstName'] . ' ' . $row['userLastName'] . "</td>");
    echo("<td>" . $row['userEmail'] . "</td>");
    echo("<td>" . $row['userPhone'] . "</td>");
    echo("<td>" . $row['userAddress'] . '<br> ' . $row['userCity']  . ', ' .  $row['userPostalCode'] . "</td>");
    echo("<td> <a href='editUser.php?id=$id'>Edit</a> | ");
    echo("<a href='deleteUser.php?id=$id'>Delete</a> </td>");
    echo("</tr>");
  }
  echo("</table>")

?>
<h3>Products</h3>

<?php
  require_once("serverCode/connect.php");
  $sql = "Select * FROM products;";

  $result = $mysqli->query($sql);

  echo("<table border=1>");
  echo("<tr><th>ID</th><th>Name</th><th>Product Description</th><th>Cost</th><th>INV</th></tr>");
  while($row = $result->fetch_assoc()) {
    $id = $row['productsID'];
    echo("<tr>");
    echo("<td>$id</td>");
    echo("<td>" . $row['productsName'] . 		"</td>");
    echo("<td>" . $row['productsDesc'] . 		"</td>");
    echo("<td>" . $row['productsCost'] . 		"</td>");
    echo("<td>" . $row['productsInv'] . 		"</td>");	
    
    echo("<td> <a href='editProduct.php?id=$id'>Edit</a> | ");
    echo("<a href='deleteProduct.php?id=$id'>Delete</a> </td>");
    echo("</tr>");
  }
  echo("</table>")


?>

<?php require_once("footer.php"); ?>