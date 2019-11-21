<html>
<head>
<title>Add New FR Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewPartNumber_FR.php" method="post">




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
						<label for="ferrite_matl">Ferrite Material:</label>
			<input class="u-full-width" type="text" name="ferrite_matl" placeholder = "">
		</div>
		
		<div class="two column">
						<label for="dielectric_matl">Dielectric Material:</label>
			<input class="u-full-width" type="text" name="dielectric_matl" placeholder = "">
		</div>
</div>	

<!-- Container for inputing data-->
<div class="container">	
		<div class="two column">
						<label for="ferrite_dia">Ferrite Diameter (mm):</label>
			<input class="u-full-width" type="text" name="ferrite_dia" placeholder = "in mm">
		</div>
		
		<div class="two column">
						<label for="dielectric_dia">Dielectric Diameter (mm):</label>
			<input class="u-full-width" type="text" name="dielectric_dia" placeholder = "in mm">
		</div>
</div>	

<div class="container">
	<div class="row">
		<div class="two column">
			<!-- Input data using radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Plating:</b></span><br>
					<input type="radio" name="plating" value="None" checked> None<br>
					<input type="radio" name="plating" value="Silver"> Silver<br>
					<input type="radio" name="plating" value="Other"> Other<br>
				</label>
			</fieldset>
		</div>


		<div class="two column">
			<!-- Input data with radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Shape:</b></span><br>
					<input type="radio" name="shape" value="Circular" checked> Circular<br>
					<input type="radio" name="shape" value="Triangle"> Triangle<br>
					<input type="radio" name="shape" value="Square"> Square<br>
					<input type="radio" name="shape" value="Other"> Other<br>
				</label>
			</fieldset>
		</div>
	
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="two column">
						<label for="thickness">Thickness (mm):</label>
			<input class="u-full-width" type="text" name="thickness" placeholder = "in mm">
		</div>
		<div class="two column">
			<!-- Input data with radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Roughness:</b></span><br>
					<input type="radio" name="roughness" value="1.0Ra" checked> 1.0Ra<br>
					<input type="radio" name="roughness" value="0.8Ra"> 0.8Ra<br>
					<input type="radio" name="roughness" value="Other"> Other<br>
				</label>
			</fieldset>
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
		$ferrite_matl = trim($_POST['ferrite_matl']);
		$dielectric_matl = trim($_POST['dielectric_matl']);
		$ferrite_dia = trim($_POST['ferrite_dia']);
		$dielectric_dia = trim($_POST['dielectric_dia']);
		$thickness = trim($_POST['thickness']);
		$shape = trim($_POST['shape']);
		$plating = trim($_POST['plating']);
		$roughness = trim($_POST['roughness']);
		$entered_by = trim($_POST['entered_by']);
		$size_code = trim($_SESSION['size_code']);
	
		//Create MySQL insert statement
		$sql = "INSERT INTO " . $_SESSION['part_type'] . " (part_number,  size_code, ferrite_matl, dielectric_matl, ferrite_dia, dielectric_dia, thickness, shape, plating, roughness, entered_by) 
		VALUES ('$part_number','$size_code','$ferrite_matl','$dielectric_matl','$ferrite_dia','$dielectric_dia','$thickness','$shape','$plating','$roughness' ,'$entered_by');";
		
	
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
