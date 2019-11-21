<html>
<head>
<title>Add New Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewpartnumbercoverpage.php" method="post">


<!-- Select sql table-->
<div class="container">	
	<div class="row">
		<div class="four column">       
		   <fieldset>
			  <p>
				 <label>Select Part Type</label>
				 <select id = "part_type">
				   <option value = "AD">AD</option>
				   <option value = "CR">CR</option>
				 </select>
			  </p>
		   </fieldset>
		</div>
	</div>
</div>

<br>



<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="four columns">
		<input class="button-success" type="submit" name="submit" value="Select" />
		</div>
	</div>	
</div>

</form>
</body>
</html>

<?php



	
	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//let's start the session
		session_start();

		//now, let's register our session variables
		session_register('part_type');

		//finally, let's store our posted values in the session variables
		$_SESSION['part_type'] = $_POST['part_type'];
		
		echo $_SESSION['part_type'];
	
		//Create MySQL insert statement
		//$sql = "INSERT INTO ad (part_number,  description, entered_by) 
		//VALUES ('$part_number','$description', '$entered_by');";
		
	
		//Insert to database then close
		//require_once('./mysqli_connect.php');
		//mysqli_query($dbc,$sql);
		//mysqli_close($dbc);

		//Confirm new record inserted 
        //if ($sql) {
		//		echo "New Part Number added successfully....refreshing....";
		//		echo '<meta http-equiv="refresh" content="2">';
		//} else {
		//		echo "Error: ";
		//		}
			
	}

?>
