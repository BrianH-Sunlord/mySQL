<html>
<head>
<title>Add New Inventory Location</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewInventoryLocation.php" method="post">

<br><h3>Add New Inventory Location</h3><br>

<!-- Container for inputing data-->
<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="three column">
						<label for="location_name">Location Name:</label>
			<input class="u-full-width" type="text" name="location_name" placeholder = "10 characters maximum">
		</div>
</div>

<div class="container">	
	<div class="row">		
		<div class="three column">
			  <label for="location_description">Location Description:</label>
			  <textarea class="u-full-width" name="location_description" placeholder = ""></textarea>
		</div>
	</div>
</div>

<br>

	
<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Add This New Location to Database" />
		</div>
	</div>	
</div>

</form>
</body>
</html>

<?php
	
	//If submit button is pushed
	if(isset($_POST['submit'])){
		
		//Set inputs equal to variables
		$location_name = trim($_POST['location_name']);
		$location_description = trim($_POST['location_description']);
	
	
		//Create MySQL insert statement
		$sql = "INSERT INTO inventory_location (location_name,  location_description) 
		VALUES ('$location_name','$location_description');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);

		//Confirm new record inserted 
        if ($sql) {
				echo "New Inventory Location added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="4">';
		} else {
				echo "Error: ";
				}
			
	}

?>
