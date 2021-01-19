<html>
<head>
<title>Download Test Report</title>

<!-- Get style format files-->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>


<body>
<!-- Assign this php file to perform action on form-->
<form action="DownloadTestReport.php" method="post">
         


<!-- Container for inputing data-->
<h3>Download Test Report</h3>

<br>

<div class="container">	
	<div class="row">
		<!-- Input data using decimal box-->
		<div class="four column">
						<label for="drawing_number">Enter DVRFxxxxx Number:</label>
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
		<input class="button-success" type="submit" name="submit" value="Test Reports for this P/N" />
		</div>
	</div>	

</div>

<br><br><br>

<a href="UploadTestReport.php">Add a Test Report</a>

</form>
</body>
</html>

<?php
	//$target_dir = "d://docvault/"; //change to d://docvault/ for shared drive
	
	//If submit button is pushed
	if (isset($_POST['submit']) && $_POST['submit'] !== ""){
	
		//Connect to database
		require_once('./mysqli_connect.php');

	 	//Set inputs equal to variables
		$drawing_number = trim($_POST['drawing_number']);
		
	
		//Create MySQL statement
		$sql = "SELECT * FROM test_report WHERE drawing_number = '" . $drawing_number . "' ORDER BY timestamp DESC;";
		

		//Select column names from database and create table header row
			$result = mysqli_query($dbc,$sql);
		
		//Create table		
			echo '<table><tr>';
			echo '<th>Part Number</th>';
			echo '<th>Date</th>';
			echo '<th>Download Link</th></tr>';
			
			while($row = mysqli_fetch_array($result)){
				$field1name = $row['drawing_number'];
				$date = date("Y-M-d",strtotime($row['timestamp']));
				$link = $drawing_number . " Test Report " . $date . ".xlsx";
				
			
				echo '<tr> 
					 <td>' .$field1name. '</td>
					 <td>' .$date. '</td>
					 <td>  <a href="downloadfile.php?file=' . $link . '">Download</a></td>
					 </tr>';
			}
				
			echo '</table><br>';
		
		//Close database connection
		mysqli_close($dbc);
	}
?>
