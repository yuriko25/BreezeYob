<?php
// Script expects the following POST elements:
//    txtName, cboBase, radSize, chkOptions (as an array, optional)

// Collect base and  name selections to validate them
$name = $_POST["txtName"];
$base = $_POST["cboBase"];
// Validate for required fields: name, size and base
if($name != "" && isset($_POST["radSize"]) && $base > 0)
{
	//now that we know a radio button was in the POST array ...
	//get size to do total
	$size = $_POST["radSize"];
	

	//perform initial calcs without extra toppings costing
	$subTotal = $base + $size;
	
  // DEBUG CODE
  // echo("<pre>");
  // print_r($_POST);
  // echo("</pre>");
	// DEBUG CODE

	// Check if any options were selected
	if(isset($_POST["chkOptions"])) {
		// We'll only get here if at least one checkbox was checked

		$options = $_POST["chkOptions"];
		$optionsCount = 0;
		$optionsTotal = 0;

		foreach($options as $value) {
			$optionsTotal = $optionsTotal + $value;
			$optionsCount++;
		}
		

	} else {
		$optionsCount = 0;
		$optionsTotal = 0;
	}

	$totalCost = $subTotal + $optionsTotal;


	//output totals in table format
	echo 	"Thank-you for your order, $name. Here are your order details:
			<table border='1'>
				<tr>
					<td>Sub Total:</td>
					<td>$$subTotal</td>
				</tr>
				<tr>
					<td>Number of Creams:</td>
					<td>$optionsCount</td>
				</tr>
				<tr>
					<td>Options Total:</td>
					<td>$$optionsTotal</td>
				</tr>
				<tr>
					<td>Total:</td>
					<td>$$totalCost</td>
				</tr>
			<table>"; 
}
else
	//user didn't supply all required fields - error message
	echo "Your name, base pizza and size selections are required";
?>
