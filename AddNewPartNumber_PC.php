<html>
<head>
<title>Add New PC Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewPartNumber_PC.php" method="post">




<div class="container">	
	<div class="row">
		<div class="four columns">
			<!-- Dropdown menu pulled from database input box using php-->
			<?php	
			//get variable from previous page
			session_start();
				
						
			// Get a connection for the database
			require_once('./mysqli_connect.php');
			
			$part_code = "'". $_SESSION['part_type'] . "-". $_SESSION['size_code'] ."%'";

			$sql = "SELECT * FROM " . $_SESSION['part_type'] . " WHERE part_number LIKE " . $part_code . " ORDER BY part_number DESC LIMIT 1";
			$result = mysqli_query($dbc,$sql);
			while ($row = mysqli_fetch_array($result)) {
		
			//get last number, convert to string, get last 4 digits, convert to int and the increment by one to create new number
			$lastNumber = $row['part_number'];
			$stringresult = (string)$lastNumber;
			$digits = substr($stringresult, -4);
			$digits = (int) ltrim($digits, '0');
			$digits++;
			$part_number = $_SESSION['part_type'] . "-" . $_SESSION['size_code'] ."-". sprintf("%04d", $digits);
			?>

						<h3>New Part Number: <br>
			
			<?php
			echo $part_number;
			}
			?>
			</h3><br>

		</div>
	</div>
</div>

<!-- Container for inputing data-->
<div class="container">	
		<div class="two column">
						<label for="diameter">Part Diameter (mm):</label>
			<input class="u-full-width" type="text" name="diameter" placeholder = "in mm">
		</div>
		
		<div class="two column">
						<label for="thickness">PCB Thickness (mm):</label>
			<input class="u-full-width" type="text" name="thickness" placeholder = "in mm">
		</div>
</div>	

<!-- Container for inputing data-->
<div class="container">	
		<div class="two column">
						<label for="material">Material:</label>
			<input class="u-full-width" type="text" name="material" placeholder = "">
		</div>
		
		<div class="two column">
			<fieldset>
				<label>
					<span class="label-body"><b>Type:</b></span><br>
					<input type="radio" name="type" value="Circulator" checked> Circulator<br>
					<input type="radio" name="type" value="Isolator"> Isolator<br>
					<input type="radio" name="type" value="Attenuator"> Attenuator<br>
					<input type="radio" name="type" value="Other"> Other<br>
				</label>
			</fieldset>
		</div>
</div>	

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="four column">
						<label for="description">Description or Test Fixture P/N:</label>
			<input class="u-full-width" type="text" name="description" placeholder = "">
		</div>
	</div>
</div>


<br>

	
<!-- Dropdown menu pulled from database of names-->
<div class="container">		
	<div class="row">
		<div class="four columns">
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
		<div class="four columns">
		<input class="button-success" type="submit" name="submit" value="Add This New Part Number to Database" />
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
		$diameter = trim($_POST['diameter']);
		$thickness = trim($_POST['thickness']);
		$material = trim($_POST['material']);
		$type = trim($_POST['type']);
		$description = trim($_POST['description']);
		$entered_by = trim($_POST['entered_by']);
		$size_code = trim($_SESSION['size_code']);
	
		//Create MySQL insert statement
		$sql = "INSERT INTO " . $_SESSION['part_type'] . " (part_number,  size_code, diameter, thickness, material, type, description, entered_by) 
		VALUES ('$part_number','$size_code','$diameter','$thickness','$material','$type','$description' ,'$entered_by');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);

		//Confirm new record inserted 
        if ($sql) {
				echo "New part number added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="2">';
		} else {
				echo "Error: ";
				}
		
		header('Location: AddNewPartNumberCoverPage.php');	
	}

?>
