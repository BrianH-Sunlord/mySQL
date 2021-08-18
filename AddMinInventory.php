<html>
<head>
<title>Add Minimum Inventory Requirement</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddMinInventory.php" method="post">

<br><h3>Add Minimum Inventory Requirement</h3>

<!-- Container for inputing data-->
<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="two column">
						<label for="part_number">Part Number:</label>
			<input class="u-full-width" type="text" name="part_number" placeholder = "">
		</div>
		<div class="one column">
					<label for="min_qty">Qty:</label>
			<input class="u-full-width" type="text" name="min_qty" placeholder = "">
		</div>
	</div>
</div>

<div class="container">	
	<div class="row">		
		<div class="three column">
			  <label for="comment">Comments:</label>
			  <textarea class="u-full-width" name="comment" placeholder = "optional"></textarea>
		</div>
	</div>
</div>

<br>

	
<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Add"/>
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
		$part_number = trim($_POST['part_number']);
		$min_qty = trim($_POST['min_qty']);
		$comment = trim($_POST['comment']);
	
	
		//Create MySQL insert statement
		$sql = "INSERT INTO inventory_min (part_number, min_qty, comment) 
		VALUES ('$part_number','$min_qty','$comment');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);

		//Confirm new record inserted 
        if ($sql) {
				echo "Added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="4">';
		} else {
				echo "Error: ";
				}
			
	}

?>
