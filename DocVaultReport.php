<html>
<head>
<title>Document Vault History by Part Number</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="DocVaultReport.php" method="post">
         


<!-- Container for inputing data-->
<h3>Document History</h3>

<div class="container">	
	<div class="three columns">
	<!-- Radio Button box-->
		<fieldset>
		<label>
			<span class="label-body"><b>Select type:</b></span><br>
			<input type="radio" name="type" value="long" checked> AA-BB-XXXX<br>
			<input type="radio" name="type" value="short"> AA-XXXX<br>
			<input type="radio" name="type" value="datasheet"> Datasheet<br>
			<input type="radio" name="type" value="testfile"> Test File<br>
		</label>
		</fieldset>
	</div>
</div>

<br>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="three column">
						<label for="drawing_number">Drawing Number or DVRFxxxxx:</label>
			<input class="u-full-width" type="text" name="drawing_number" placeholder = "">
		</div>
	</div>
</div>

<br>

	

<br>

<!-- Submit button-->
<div class="container">	
	
	<div class="row">
		<div class="three columns">
		<input class="button-success" type="submit" name="submit" value="Get history" />
		</div>
	</div>	

</div>

</form>
</body>
</html>

<?php
	//If submit button is pushed
	if (isset($_POST['submit']) && $_POST['submit'] !== ""){
	
		//Connect to database
		require_once('./mysqli_connect.php');

	 	//Set inputs equal to variables
		$drawing_number = trim($_POST['drawing_number']);
		$type = trim($_POST['type']);
		
		//Create MySQL statement
		$sqlA = "SELECT * FROM drawing_number WHERE drawing_number.drawing_number = '" . $drawing_number . "' AND drawing_number.type = '" . $type . "' ORDER BY timestamp DESC;";
		$sqlB = "SELECT * FROM download WHERE drawing_number = '" . $drawing_number . "' AND type = '" . $type . "' ORDER BY timestamp DESC;";
		$sqlC = "SELECT * FROM upload WHERE drawing_number = '" . $drawing_number . "' AND type = '" . $type . "' ORDER BY timestamp DESC;";
		$tablename = array("drawing_number", "download", "upload");
		$sql = array($sqlA, $sqlB, $sqlC);
		$title = array("Drawing Revision History", "Download History", "Upload History");
		
		for ($x = 0; $x <= 2; $x++) {
		//Select column names from database and create table header row
			$column_sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='sunlord' AND `TABLE_NAME`='" . $tablename[$x] . "'";
			$result = mysqli_query($dbc,$column_sql);
		
		//Make columns an array variable	
			$columns = array();
			
		//Create table header row and fill in column array variable	
			echo $title[$x];
			
			echo '<table><tr>';
				while($row = mysqli_fetch_array($result)){
				echo '<th>'.$row['COLUMN_NAME'].'</th>';
				$columns[] = $row['COLUMN_NAME'];
				}
			echo '</tr>';

		//Pull all data and fill in table	
			$result = mysqli_query($dbc,$sql[$x]);
			echo '<tr>';
				
			while($row = mysqli_fetch_array($result)){
				foreach($columns as $column){
				echo '<td>'.$row[$column].'</td>';
				}
			
			echo '<tr>';
			}
			
			echo '</table><br>';
		

		}
		
		//Close database connection
		mysqli_close($dbc);
	}

	
?>
