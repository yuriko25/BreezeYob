<!DOCTYPE html>
<html lang="en">
<head>
<script src="http://code.jquery.com/jquery-latest.js">
  <script type="text/javascript">
    setInterval("my_function();",5000); 
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }
  </script>
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
<script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'products.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 5000);  // it will refresh your data every 5 sec

    });
</script>
  <?php 
    if(session_status() === PHP_SESSION_NONE) {
      echo "<a href='register.php'>Register</a> | ";
      echo "<a href='login.php'>Login</a>";
    } else{
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