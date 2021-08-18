<html>
<head>
<title>Inventory Out</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="InventoryOut.php" method="post">

<br><h3>Inventory Out</h3><br>

<!-- Container for inputing data-->
<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="two column">
						<label for="part_number">Part Number:</label>
			<input class="u-full-width" type="text" name="part_number" placeholder = "use CAPITAL letters">
		</div>
		<div class="one column">
						<label for="rev">Revision:</label>
			<input class="u-full-width" type="text" name="rev" placeholder = "">
		</div>
	</div>	
</div>

<div class="container">	
	<div class="row">		
		<div class="three column">
			  <label for="description">Comment:</label>
			  <textarea class="u-full-width" name="description" placeholder = "optional"></textarea>
		</div>
	</div>
</div>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="three column">
						<label for="qty">Quantity:</label>
			<input class="u-full-width" type="text" name="qty" placeholder = "">
		</div>
	</div>	
</div>

<!-- Dropdown menu pulled from database of locationss-->
<div class="container">		
	<div class="row">
		<div class="three columns">
				<?php	
				require_once('./mysqli_connect.php');
				$sql = "SELECT location_name FROM inventory_location ORDER BY location_name";
				$result = mysqli_query($dbc,$sql);
				?>
			<label for="location">Inventory Location:</label>
			<select class="u-full-width" name='location'>
				<?php
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['location_name'] . "'>" . $row['location_name'] . "</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>	

<!-- Dropdown menu pulled from database of names-->
<div class="container">		
	<div class="row">
		<div class="three columns">
				<?php	
				require_once('./mysqli_connect.php');
				$sql = "SELECT name FROM name ORDER BY name";
				$result = mysqli_query($dbc,$sql);
				?>
			<label for="entered_by">Entered by:</label>
			<select class="u-full-width" name='entered_by'>
				<?php
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>	

<br>

	
<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Submit" />
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
		$rev = trim($_POST['rev']);
		$description = trim($_POST['description']);
		$qty = trim($_POST['qty']);
		$location = trim($_POST['location']);
		$entered_by = trim($_POST['entered_by']);
		
		//Change qty to negative number
		$qty = -1 * abs($qty);
		
		//Create MySQL insert statement
		$sqlA = "INSERT INTO inventory_transaction (part_number, rev, description, qty, location, entered_by) 
		VALUES ('$part_number', '$rev', '$description', '$qty', '$location', '$entered_by');";
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sqlA);
		
		//Checks if part_number+location is already in database
		$sqlB = "SELECT EXISTS(SELECT * FROM inventory WHERE inventory.part_number = '" . $part_number . "' AND inventory.rev = '" . $rev . "' AND inventory.location = '" . $location . "');";
		require_once('./mysqli_connect.php');
		$result = mysqli_query($dbc,$sqlB);
		$status = $result->fetch_array()[0] ?? '';
		
		//If in database, get qty
		if ($status == 1) {

			// Gets qty from inventory database
			$sqlC = "SELECT qty FROM inventory WHERE part_number= '" . $part_number . "' AND rev= '" . $rev . "' AND location= '" . $location . "' LIMIT 1;";
			require_once('./mysqli_connect.php');
			$result = mysqli_query($dbc, $sqlC) or die(mysql_error());
			$row = mysqli_fetch_assoc($result);
			$inventory_qty = (int)$row['qty'];
			$new_inventory_qty = $inventory_qty + $qty;
			
			$sqlD = "UPDATE inventory SET qty = '" . $new_inventory_qty . "' WHERE part_number= '" . $part_number . "' AND rev= '" . $rev . "' AND location= '" . $location . "';";
			require_once('./mysqli_connect.php');
			mysqli_query($dbc,$sqlD);
					
		//If not in database, set old revision to <A
		} else {
				$sqlE = "INSERT INTO inventory (part_number, rev, description, qty, location) 
				VALUES ('$part_number', '$rev', '$description', '$qty', '$location');";
				require_once('./mysqli_connect.php');
				mysqli_query($dbc,$sqlE);
		}		

		//Confirm new record inserted 
        if ($sql) {
				echo "Inventory updated successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="4">';
		} else {
				echo "Error: ";
				}
			
	}

?>
