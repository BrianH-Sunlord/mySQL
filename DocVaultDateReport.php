<html>
<head>
<title>Document Vault Date Report</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  
<!-- Get date picker -->  
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#date1").datepicker({
				dateFormat: "yy-mm-dd"
						});
			$("#date2").datepicker({
				dateFormat: "yy-mm-dd"
						});
        });
		

    </script>
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="DocVaultDateReport.php" method="post">

<!-- Container for inputing data-->
<h3>Document History by Date Range</h3>

<br>

<div class="container">	
	<div class="row">
		<div class="three column">
			    <label for="datepicker">Enter Start Date:</label>
                <input type="text" name="start_date" id="date1" autocomplete="off" />
                </div>
	</div>
</div>

<br>

<div class="container">	
	<div class="row">
		<div class="three column">
			    <label for="datepicker">Enter Stop Date:</label>
                <input type="text" name="stop_date" id="date2" autocomplete="off" />
                </div>
	</div>
</div>

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
		$start_date = trim($_POST['start_date']);
		$stop_date = trim($_POST['stop_date']);
		
		//Create MySQL statement
		$sqlA = "SELECT * FROM drawing_number WHERE timestamp BETWEEN '" . $start_date . "' AND '" . $stop_date . "' ORDER BY timestamp DESC;";
		$sqlB = "SELECT * FROM download WHERE timestamp BETWEEN '" . $start_date . "' AND '" . $stop_date . "' ORDER BY timestamp DESC;";
		$sqlC = "SELECT * FROM upload WHERE timestamp BETWEEN '" . $start_date . "' AND '" . $stop_date . "' ORDER BY timestamp DESC;";
		$tablename = array("drawing_number", "download", "upload");
		$sql = array($sqlA, $sqlB, $sqlC);
		$title = array("Drawing Revision History", "Download History", "Upload History");
		
		//Display date range selected
		echo "From " . date("M j Y", strtotime($start_date)) . " to " . date("M j Y", strtotime($stop_date)) .":";
		echo '<br><br>';
		
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
