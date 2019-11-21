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
<form action="AddNewAnypartnumber.php" method="post">


<!-- Get next available number from database-->	

	<div class="row">
		<div class="ten columns offset-by-one">
		<!-- Dropdown menu pulled from database input box using php-->
			<?php	
			//let's start the session
			session_start();
			
			echo $_SESSION['part_type'];
			
			
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


<!-- Container for inputing data-->
<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="two column">
						<label for="start_freq">Start Frequency (MHz):</label>
			<input class="u-full-width" type="text" name="start_freq" placeholder = "">
		</div>

		<div class="two column">
			  <label for="stop_freq">Stop Frequency (MHz):</label>
			  <input class="u-full-width" type="text" name="stop_freq" placeholder = "">
		</div>
	</div>
	
	<!-- Input data using decimal box-->
	<div class="row">
		<div class="two column">
			  <label for="low_temp">Minimum Temp (C):</label>
			  <input class="u-full-width" type="text" name="low_temp" placeholder = "in C">
		</div>

		<div class="two column">
			  <label for="high_temp">Maximum Temp (C):</label>
			  <input class="u-full-width" type="text" name="high_temp" placeholder = "in C">
		</div>
	</div>
</div>


<!-- Container for inputing data-->
<div class="container">
	<div class="row">
		<div class="two column">
			<!-- Input data using radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Type:</b></span><br>
					<input type="radio" name="type" value="Circulator" checked> Circulator<br>
					<input type="radio" name="type" value="Isolator"> Isolator<br>
					<input type="radio" name="type" value="Attenuator"> Attenuator<br>
				</label>
			</fieldset>
		</div>


		<div class="two column">
			<!-- Input data with radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Configuration::</b></span><br>
					<input type="radio" name="config" value="Pin" checked> Pin<br>
					<input type="radio" name="config" value="Tab"> Tab<br>
					<input type="radio" name="config" value="Connector"> Connector<br>
				</label>
			</fieldset>
		</div>
	
	</div>
</div>

<br>

<div class="container">
<div class="row">
	<div class="two columns">
		<fieldset>
		<label>
			<span class="label-body"><b>Junctions:</b></span><br>
			<input type="radio" name="junction" value="1" checked> 1<br>
			<input type="radio" name="junction" value="2"> 2<br>
		</label>
		</fieldset>
	</div>

	
	<div class="two columns">	
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Rotation:</b></span><br>
			<input type="radio" name="rotation" value="CW"> CW<br>
			<input type="radio" name="rotation" value="CCW"> CCW<br>
		</label>
		</fieldset>	
	</div>
</div>	
</div>

<div class="container">
<div class="row">
	<div class="two columns">	
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Platform:</b></span><br>
			<input type="radio" name="platform" value="SMT" checked> SMT<br>
			<input type="radio" name="platform" value="Drop in"> Drop in<br>
		</label>
		</fieldset>	
	</div>
	
	<!-- Input data using decimal box-->
		<div class="two column">
			<!-- Input data with radio buttons-->
			<fieldset>
				<label>
					<span class="label-body"><b>Customer:</b></span><br>
					<input type="radio" name="customer" value="Huawei" checked> Huawei<br>
					<input type="radio" name="customer" value="Ericsson"> Ericsson<br>
					<input type="radio" name="customer" value="Nokia"> Nokia<br>
					<input type="radio" name="customer" value="Samsung"> Samsung<br>
					<input type="radio" name="customer" value="Other"> Other<br>
				</label>
			</fieldset>
		</div>	
	
	
	</div>
</div>


<!-- Container for inputing data-->
<div class="container">	

		<!-- Input data using decimal box-->
		<div class="two column">
						<label for="size">Diameter (mm):</label>
			<input class="u-full-width" type="text" name="size" placeholder = "">
		</div>
</div>		
		
<div class="container">	
		<div class="two column">
			  <label for="od">Outline Drawing:</label>
			  <input class="u-full-width" type="text" name="od" placeholder = "OD-xxxxx">
		</div>
</div>

	
<div class="container">	
		<div class="two column">
			  <label for="customer_part_number">Customer Part Number:</label>
			  <input class="u-full-width" type="text" name="customer_part_number" placeholder = "">
		</div>
</div>


<br>

	
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

<!-- Submit button-->
<div class="container">	
	<div class="row">
		<div class="three columns">
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
		$start_freq = trim($_POST['start_freq']);
		$stop_freq = trim($_POST['stop_freq']);
		$low_temp = trim($_POST['low_temp']);
		$high_temp = trim($_POST['high_temp']);
		$type = trim($_POST['type']);
		$config = trim($_POST['config']);
		$junction = trim($_POST['junction']);
		$rotation = trim($_POST['rotation']);
		$platform = trim($_POST['platform']);
		$size = trim($_POST['size']);
		$od = trim($_POST['od']);
		$customer = trim($_POST['customer']);
		$customer_part_number = trim($_POST['customer_part_number']);
		$entered_by = trim($_POST['entered_by']);
		
	
		//Create MySQL insert statement
		$sql = "INSERT INTO dvrf_part_number (part_number,  start_freq, stop_freq, low_temp, high_temp, type, config, junction, rotation, platform, size, od, customer, customer_part_number, entered_by) 
		VALUES ('$dvrf_number','$start_freq' ,'$stop_freq', '$low_temp' , '$high_temp','$type', '$config','$junction', '$rotation', '$platform', '$size', '$od', '$customer', '$customer_part_number', '$entered_by');";
		
	
		//Insert to database then close
		require_once('./mysqli_connect.php');
		mysqli_query($dbc,$sql);
		mysqli_close($dbc);

		//Confirm new record inserted 
        if ($sql) {
				echo "New DVRF Number added successfully....refreshing....";
				echo '<meta http-equiv="refresh" content="4">';
		} else {
				echo "Error: ";
				}
			
	}

?>
