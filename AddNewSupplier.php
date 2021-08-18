<html>
<head>
<title>Add New Supplier</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewSupplier.php" method="post">

<br><h3>Add New Supplier</h3><br>

<!-- Container for inputing data-->
<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="three column">
						<label for="name">Supplier Name:</label>
			<input class="u-full-width" type="text" name="name" placeholder = "15 characters maximum">
		</div>
</div>

<div class="container">	
	<div class="row">		
		<div class="three column">
			  <label for="description">Description:</label>
			  <textarea class="u-full-width" name="description" placeholder = ""></textarea>
		</div>
	</div>
</div>

<br>

	
<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Add This New Supplier" />
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
		$name = trim($_POST['name']);
		$description = trim($_POST['description']);
	
	
		//Create MySQL insert statement
		$sql = "INSERT INTO inventory_supplier (name, description) 
		VALUES ('$name','$description');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);

		//Confirm new record inserted 
        if ($sql) {
				echo "New Supplier added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="4">';
		} else {
				echo "Error: ";
				}
			
	}

?>
