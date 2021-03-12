<html>
<head>
<title>Add New REL Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="AddNewPartNumber_REL.php" method="post">




<div class="container">	
	<div class="row">
		<div class="four columns">
		<!-- Dropdown menu pulled from database input box using php-->
			<?php	
			//get variable from previous page
			session_start();
			
			// Get a connection for the database
			require_once('./mysqli_connect.php');
			$sql = "SELECT * FROM " . $_SESSION['part_type'] . " ORDER BY part_number DESC LIMIT 1";
			$result = mysqli_query($dbc,$sql);
			while ($row = mysqli_fetch_array($result)) {
		
			//get last number, convert to string, get last 4 digits, convert to int and the increment by one to create new number
			$lastNumber = $row['part_number'];
			$stringresult = (string)$lastNumber;
			$digits = substr($stringresult, -4);
			$digits = (int) ltrim($digits, '0');
			$digits++;
			$part_number = $_SESSION['part_type'] . "-" . sprintf("%04d", $digits);
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
	<div class="four columns">
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Select type of testing:</b></span><br>
			<input type="radio" name="type" value="1000 hours"> 1000 hours<br>
			<input type="radio" name="type" value="100 hours"> 100 hours<br>
			<input type="radio" name="type" value="Power test"> Power test<br>
			<input type="radio" name="type" value="other"> Other<br>

		</label>
		</fieldset>
	</div>
</div>


<div class="container">	
		<div class="two column">
						<label for="dvrfnumber">DVRFxxxxx:</label>
			<input class="u-full-width" type="text" name="dvrfnumber" placeholder = "DVRFxxxxx">
		</div>
		
		<div class="two column">
						<label for="platform">Platform:</label>
			<input class="u-full-width" type="text" name="platform" placeholder = "">
		</div>
</div>	

<!-- Container for inputing data-->
<div class="container">	
		<div class="four column">
						<label for="comments">Comments:</label>
			<textarea class="u-full-width" name="comments" placeholder = ""></textarea>
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
		$type = trim($_POST['type']);
		$dvrfnumber = trim($_POST['dvrfnumber']);
		$platform = trim($_POST['platform']);
		$comments = trim($_POST['comments']);
		$entered_by = trim($_POST['entered_by']);
		$size_code = trim($_SESSION['size_code']);
	
		//Create MySQL insert statement
		$sql = "INSERT INTO " . $_SESSION['part_type'] . " (part_number, type, dvrfnumber, platform, comments, entered_by) 
		VALUES ('$part_number','$type','$dvrfnumber','$platform','$comments','$entered_by');";
		
	
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
