$(function() {
// "Capture" and handle the form's submit event. 
    $("form").submit(function(event) {  
      // Stop submission
      event.preventDefault(); 
      console.log("1: grab submit form");
//List all variables to be captured
		var txtFirstName = $("#txtFirstName").val();
		var txtLastName = $("#txtLastName").val();
        var txtAddress = $("#txtAddress").val();      
		var txtCity = $("#txtCity").val();
        var txtPostalCode = $("#txtPostalCode").val();
		var txtPhoneNumber = $("#txtPhoneNumber").val();
		var txtEmail = $("#txtEmail").val();

//Clear previous messages if any
      $("#errorMessage").html("");  
	    $(".error").removeClass("error");
	    console.log("2: clear previous error messages");

      var error = false;
      var errorMessage = "";

//First Name checks
      if(txtFirstName == "") {
        error = true;
        $("#txtFirstName").addClass("error");
        errorMessage += "First Name required<br>\n";
        console.log("3: FName: " + txtFirstName);
      }
//Last Name check
      if(txtLastName.trim() == "") {
        error = true;
        $("#txtLastName").addClass("error");
        errorMessage += "Last Name required<br>\n";
		    console.log("4: LName: " + txtLastName);
      }
//Address check
      if(txtAddress.trim() == "") {
        error = true;
        $("#txtAddress").addClass("error");
        errorMessage += "Address required<br>\n";
        console.log("5: Address: " + txtAddress);
      }
//City check
      if(txtCity.trim() == "") {
        error = true;
        $("#txtCity").addClass("error");
        errorMessage += "City required<br>\n";
        console.log("6: City: " + txtCity);
      }
//Postal Code check
      if(txtPostalCode.trim() == "") {
        error = true;
        $("#txtPostalCode").addClass("error");
        errorMessage += "Postal Code required<br>\n";
        console.log("7: Postal: " + txtPostalCode);
      }     
      //if the error tag has been added, produce the error message
      if(error) {
          $("#errorMessage").html(errorMessage);
        } 
      else { }
        // >>> If not valid, show an appropriate error message inline (inside the div with id=errorMessage)
      if(error){
        $("#errorMessage").html(errorMessage);      
		    console.log("14: error message");
				//alert("There was an error in your submission. please fix it.");
			} else {
// >>> If valid....
//Create variables
		var name = txtFirstName + " " + txtLastName;
		var address = txtAddress + ", " + txtCity;

 // Loop through checked checkboxes to list all, gets each variable clicked    
        // Output message for submission
        var output = "Than you for your order " + txtFirstName + "\n"
				+ "  Name:      " + name + "\n"
				+ "  Address:     " + address + "\n"    
  alert(output);
		  }          
      }); //form function
  }); //open function